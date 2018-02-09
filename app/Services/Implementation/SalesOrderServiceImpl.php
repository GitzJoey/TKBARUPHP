<?php
/**
 * Created by PhpStorm.
 * User: miftah.fathudin
 * Date: 11/14/2016
 * Time: 12:29 PM
 */

namespace App\Services\Implementation;

use App\Model\Item;
use App\Model\Stock;
use App\Model\Lookup;
use App\Model\Deliver;
use App\Model\Expense;
use App\Model\Product;
use App\Model\Payment;
use App\Model\Customer;
use App\Model\StockOut;
use App\Model\SalesOrder;
use App\Model\CashPayment;
use App\Model\ProductUnit;

use App\Services\PaymentService;

use DB;
use Config;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Services\SalesOrderService;

class SalesOrderServiceImpl implements SalesOrderService
{

    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Save(create) a newly sales order. The saved(created) sales order will be returned.
     * Multiple sales orders can be created at once and all of them will be saved to user session as an array by default.
     * This method will only save the sales order at sales order array in user session with given index and will remove it from that array.
     *
     * @param Array $soData object which contains values from create form to create the sales order.
     * @return void
     */
    public function createSO(Array $soData)
    {
        Log::info("[SalesOrderServiceImpl@createSO]");

        DB::beginTransaction();
        try {
            if ($soData['customer_type']['code'] == 'CUSTOMERTYPE.R') {
                $customer_id = empty($soData['customer']['id']) ? 0 : $soData['customer']['id'];
                $walk_in_cust = '';
                $walk_in_cust_detail = '';
            } else {
                $customer_id = 0;
                $walk_in_cust = $soData['walk_in_cust'];
                $walk_in_cust_detail = $soData['walk_in_cust_details'];
            }

            $so = [
                'customer_type' => $soData['customer_type']['code'],
                'customer_id' => $customer_id,
                'walk_in_cust' => $walk_in_cust,
                'walk_in_cust_detail' => $walk_in_cust_detail,
                'code' => $soData['so_code'],
                'so_type' => $soData['sales_type']['code'],
                'so_created' => date('Y-m-d H:i:s', strtotime($soData['so_created'])),
                'shipping_date' => date('Y-m-d H:i:s', strtotime($soData['shipping_date'])),
                'status' => Lookup::whereCode('SOSTATUS.WD')->first()->code,
                'vendor_trucking_id' => empty($soData['vendorTrucking']['id']) ? 0 : $soData['vendorTrucking']['id'],
                'warehouse_id' => $soData['warehouse']['id'],
                'remarks' => $soData['remarks'],
                'internal_remarks' => $soData['internal_remarks'],
                'private_remarks' => $soData['private_remarks'],
                'store_id' => Auth::user()->store_id,
                'disc_percent' => $soData['disc_percent'],
                'disc_value' => $soData['disc_value']
            ];

            $so = SalesOrder::create($so);

            foreach ($soData['items'] as $i) {
                $stock = Stock::find($i['stock_id']);
                $customer = Customer::find($customer_id);
                if (!empty($i['stock_id'])) {
                    $validator = validator(
                        [ 'quantity' => $i['quantity'] ],
                        [ 'quantity' => 'required|numeric|min:1|max:'.$stock->current_quantity ]
                    );
                    if ($validator->fails()) {
                        throw new \Exception($validator->errors()->first());
                    }
                    if ($customer && !in_array(auth()->user()->userDetail->type, [ 'USERTYPE.O', 'USERTYPE.A' ])) {
                        $latest_price = $stock->latestPrices()->first(function ($value, $key) use ($customer) {
                            return $value->price_level_id === $customer->price_level_id;
                        });
                        $validator = validator(
                            [ 'price' => $i['price'] ],
                            [ 'price' => 'required|numeric|min:'.($latest_price ? $latest_price->market_price : 0) ]
                        );
                        if ($validator->fails()) {
                            throw new \Exception($validator->errors()->first());
                        }
                    }
                }
                $item = new Item();
                $item->product_id = $i['product']['id'];
                $item->stock_id = empty($i['stock_id']) ? 0 : $i['stock_id'];
                $item->store_id = Auth::user()->store_id;
                $item->selected_unit_id = $i['selected_unit']['id'];
                $item->base_unit_id = $i['base_unit']['id'];
                $item->conversion_value = ProductUnit::whereId($item->selected_unit_id)->first()->conversion_value;
                $item->quantity = $i['quantity'];
                $item->price = floatval(str_replace(',', '', $i['price']));
                $item->to_base_quantity = $item->quantity * $item->conversion_value;

                $so->items()->save($item);
            }

            foreach ($soData['expenses'] as $expense) {
                $expense = new Expense();
                $expense->name = $expense['name'];
                $expense->type = $expense['type']['code'];
                $expense->is_internal_expense = !empty($expense['is_internal_expense']) ? $expense['is_internal_expense'] : 0;
                $expense->amount = floatval(str_replace(',', '', $expense['amount']));
                $expense->remarks = $expense['remarks'];
                $so->expenses()->save($expense);
            }

            if($so->so_type === 'SOTYPE.AC'){
                $items = $so->items;

                //Create delivers
                for($i = 0; $i < sizeof($items); $i++){
                    $conversionValue = ProductUnit::whereId($items[$i]->selected_unit_id)->first()->conversion_value;

                    $deliverParams = [
                        'deliver_date' => $so->so_created,
                        'conversion_value' => $conversionValue,
                        'brutto' => $items[$i]->quantity,
                        'base_brutto' => $conversionValue * $items[$i]->quantity,
                        'netto' => 0,
                        'base_netto' => 0,
                        'tare' => 0,
                        'base_tare' => 0,
                        'license_plate' => '',
                        'item_id' => $items[$i]->id,
                        'selected_unit_id' => $items[$i]->selected_unit_id,
                        'base_unit_id' => $items[$i]->base_unit_id,
                        'store_id' => Auth::user()->store_id,
                        'status' => ''
                    ];

                    $deliver = Deliver::create($deliverParams);

                    if($items[$i]->stock_id != 0){
                        $stockOutParams = [
                            'store_id' => Auth::user()->store_id,
                            'so_id' => $so->id,
                            'product_id' => $items[$i]->product_id,
                            'warehouse_id' => $so->warehouse_id,
                            'stock_id' => $items[$i]->stock_id,
                            'quantity' => $items[$i]->quantity
                        ];

                        $stockOut = StockOut::create($stockOutParams);

                        $stock = Stock::find($items[$i]->stock_id);
                        $stock->current_quantity -= $items[$i]->quantity;
                        $stock->save();
                    }
                }

                $this->paymentService->createCashPayment($so, $so->so_created, $so->totalAmount());

                $so->status = "SOSTATUS.C";
                $so->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Cancel a single sales order.
     * Multiple sales orders can be created at once and all of them will be saved to user session as an array by default.
     * This method will remove the sales order in sales order array in user session with given index.
     *
     * @param int $index index of the sales order in sales orders array in user session to be cancelled.
     *
     * @return void
     */
    public function cancelSO($index)
    {
        Log::info("[SalesOrderServiceImpl@cancelSO]");

        $userSOs = session(Config::get('const.SESSION.USER_SO_LIST'));
        $userSOs->splice($index, 1);
        session([Config::get('const.SESSION.USER_SO_LIST') => $userSOs]);
    }

    /**
     * Get sales order to be revised.
     *
     * @param int $id id of sales order to be revised.
     * @return SalesOrder sales order to be revised.
     */
    public function getSOForRevise($id)
    {
        Log::info("[SalesOrderServiceImpl@getSOForRevise]");

        return SalesOrder::with('items.product.productUnits.unit', 'customer.profiles.phoneNumbers.provider',
            'customer.bankAccounts.bank', 'vendorTrucking', 'warehouse', 'expenses')->find($id);
    }

    /**
     * Revise(modify) a sales order. If the sales order is still waiting for arrival, it's warehouse,
     * vendor trucking, shipping date and items can be changed. But, if it is already waiting for payment,
     * only it's items price can be changed. The revised(modified) sales order will be returned.
     *
     * @param Request $request request which contains values from revise form to revise the sales order.
     * @param int $id the id of sales order to be revised.
     * @return SalesOrder
     */
    public function reviseSO(Request $request, $id)
    {
        Log::info("[SalesOrderServiceImpl@reviseSO]");

        DB::transaction(function() use ($id, $request) {
            // Get current SO
            $currentSo = SalesOrder::with('items')->find($id);

            // Get ID of current SO's items
            $soItemsId = $currentSo->items->map(function ($item) {
                return $item->id;
            })->all();

            // Get the id of removed items
            $soItemsToBeDeleted = array_diff($soItemsId, $request->input('item_id'));

            // Remove the item that removed on the revise page
            Item::destroy($soItemsToBeDeleted);

            $currentSo->warehouse_id = $request->input('warehouse_id');
            $currentSo->shipping_date = date('Y-m-d H:i:s', strtotime($request->input('shipping_date')));
            $currentSo->remarks = $request->input('remarks');
            $currentSo->vendor_trucking_id = empty($request->input('vendor_trucking_id')) ? 0 : $request->input('vendor_trucking_id');

            for ($i = 0; $i < count($request->input('item_id')); $i++) {
                $item = Item::findOrNew($request->input("item_id.$i"));
                $item->product_id = $request->input("product_id.$i");
                $item->stock_id = empty($request->input("stock_id.$i")) ? 0 : $request->input("stock_id.$i");
                $item->store_id = Auth::user()->store_id;
                $item->selected_unit_id = $request->input("selected_unit_id.$i");
                $item->base_unit_id = $request->input("base_unit_id.$i");
                $item->conversion_value = ProductUnit::whereId($item->selected_unit_id)->first()->conversion_value;
                $item->quantity = $request->input("quantity.$i");
                $item->price = floatval(str_replace(',', '', $request->input("price.$i")));
                $item->to_base_quantity = $item->quantity * $item->conversion_value;

                $currentSo->items()->save($item);
            }

            // Get IDs of current SO's expenses
            $soExpensesId = $currentSo->expenses->map(function ($expense) {
                return $expense->id;
            })->all();

            $inputtedExpenseId = $request->input('expense_id');

            // Get the id of removed expenses
            $soExpensesToBeDeleted = array_diff($soExpensesId, isset($inputtedExpenseId) ? $inputtedExpenseId : []);

            // Remove the expenses that removed on the revise page
            Expense::destroy($soExpensesToBeDeleted);

            for($i = 0; $i < count($request->input('expense_id')); $i++){
                $expense = Expense::findOrNew($request->input("expense_id.$i"));
                $expense->name = $request->input("expense_name.$i");
                $expense->type = $request->input("expense_type.$i");
                $expense->is_internal_expense = !empty($request->input("is_internal_expense.$i"));
                $expense->amount = floatval(str_replace(',', '', $request->input("expense_amount.$i")));
                $expense->remarks = $request->input("expense_remarks.$i");

                $currentSo->expenses()->save($expense);
            }

            $currentSo->save();

            return $currentSo;
        });
    }

    /**
     * Reject a sales order. Only sales orders with status waiting for arrival can be rejected.
     *
     * @param Request $request request which contains values for sales order rejection.
     * @param $id int the id of sales order to be rejected.
     * @return void
     */
    public function rejectSO(Request $request, $id)
    {
        Log::info("[SalesOrderServiceImpl@rejectSO]");

        $so = SalesOrder::find($id);
        $so->status = 'SOSTATUS.RJT';
        $so->save();
    }

    /**
     * Store sales orders sent from the request to user session as a collection.
     * @param Request $request request which contains values for sales orders
     * @return void
     */
    public function storeToSession(Request $request)
    {
        Log::info("[SalesOrderServiceImpl@storeToSession]");

        $SOs = [];

        for($i = 0; $i < count($request->input('so_code')); $i++){
            $customer = Customer::find($request->input("customer_id.$i"));

            $items = [];
            for ($j = 0; $j < count($request->input("so_$i"."_product_id")); $j++) {
                $items[] = [
                    'quantity' => $request->input("so_$i"."_quantity.$j"),
                    'selected_unit' => ProductUnit::with('unit')->where([
                        'product_id' => $request->input("so_$i"."_product_id.$j"),
                        'unit_id' => $request->input("so_$i"."_selected_unit_id.$j")
                    ])->first(),
                    'product' => Product::with('productUnits.unit')->find($request->input("so_$i"."_product_id.$j")),
                    'stock_id' => empty($request->input("so_$i"."_stock_id.$i")) ? 0 : $request->input("so_$i"."_stock_id.$j"),
                    'base_unit' => [
                        'unit' => [
                            'id' => $request->input("so_$i"."_base_unit_id.$j")
                        ]
                    ],
                    'price' => floatval(str_replace(',', '', $request->input("so_$i"."_price.$j")))
                ];
            }

            $expenses = [];
            for ($j = 0; $j < count($request->input("so_$i"."_expense_name")); $j++) {
                $expenses[]  = [
                    'name' => $request->input("so_$i"."_expense_name.$j"),
                    'type' => [
                        'code' => $request->input("so_$i"."_expense_type.$j"),
                        'description' => $request->input("so_$i"."_expense_type_description.$j"),
                        'i18nDescription' => $request->input("so_$i"."_expense_type_i18nDescription.$j")
                    ],
                    'is_internal_expense' => $request->input("so_$i" . "_is_internal_expense.$j"),
                    'amount' => floatval(str_replace(',', '', $request->input("so_$i"."_expense_amount.$j"))),
                    'remarks' => $request->input("so_$i"."_expense_remarks.$j")
                ];
            }

            $SOs[] = [
                'customer_type' => [
                    'code' => $request->input("customer_type.$i"),
                    'description' => $request->input("customer_type_description.$i"),
                    'i18nDescription' => $request->input("customer_type_i18nDescription.$i"),
                ],
                'customer' => is_null($customer) ? ['id' => '', 'price_level' => ''] : $customer,
                'walk_in_cust' => $request->input("walk_in_customer.$i"),
                'walk_in_cust_details' => $request->input("walk_in_customer_details.$i"),
                'so_code' => $request->input("so_code.$i"),
                'sales_type' => [
                    'code' => $request->input("sales_type.$i"),
                    'description' => $request->input("sales_type_description.$i"),
                    'i18nDescription' => $request->input("sales_type_i18nDescription.$i"),
                ],
                'so_created' => $request->input("so_created.$i"),
                'shipping_date' => $request->input("shipping_date.$i"),
                'warehouse' => [
                    'id' => strval($request->input("warehouse_id.$i")),
                    'name' => $request->input("warehouse_name.$i"),
                    'hid' => $request->input("warehouse_hid.$i")
                ],
                'vendorTrucking' => [
                    'id' => strval(empty($request->input("vendor_trucking_id.$i")) ? 0 : $request->input("vendor_trucking_id.$i")),
                    'name' => empty($request->input("vendor_trucking_name.$i")) ? '' : $request->input("vendor_trucking_name.$i")
                ],
                'product' => ['id' => ''],
                'stock' => ['id' => ''],
                'remarks' => $request->input("remarks.$i"),
                'items' => $items,
                'expenses' => $expenses
            ];
        }

        return $SOs;
    }

    /**
     * Get a sales order with given code to be copied.
     *
     * @param string $soCode code of sales order to be copied.
     * @return SalesOrder sales order to be copied.
     */
    public function getSOForCopy($soCode)
    {
        Log::info("[SalesOrderServiceImpl@getSOForCopy]");

        return SalesOrder::with('items.product.productUnits.unit', 'customer.profiles.phoneNumbers.provider',
            'customer.bankAccounts.bank', 'vendorTrucking', 'warehouse')->where('code', '=', $soCode)->first();
    }

    /**
     * Get a collection of sales orders that almost due for payment.
     *
     * @param int $daysToDue number of days before the sales order payment should be received.
     * @return Collection sales order that due for payment.
     */
    public function getDueSO($daysToDue = 1)
    {
        Log::info("[SalesOrderServiceImpl@getDueSO]");

        $soWaitingForPayment = SalesOrder::with('delivers', 'customer')
            ->where('status', '=', 'SOSTATUS.WP')
            ->whereHas('customer', function($query){
                $query->where('payment_due_day', '>', 0);
            })->get();

        $today = Carbon::today();

        $dueSO = $soWaitingForPayment->filter(function($so, $key) use ($daysToDue, $today){
            $customerPaymentDueDay = $so->customer->payment_due_day;
            return $today->gte($so->delivers->first()->deliver_date->addDays($customerPaymentDueDay - $daysToDue));
        });

        return $dueSO;
    }

    /**
     * Get all sales order created on given date
     *
     * @param Carbon $date target date
     * @return Collection
     */
    public function getSOInOneDay($date)
    {
        Log::info("[SalesOrderServiceImpl@getSOInOneDay]");

       //Defensive copy, because still don't know immutability'
       $dateCopy = $date->copy();

       $startOfDay = $dateCopy->startOfDay()->toDateTimeString();
       $endOfDay = $dateCopy->endOfDay()->toDateTimeString();

       return SalesOrder::with('items')->whereBetween('so_created', [$startOfDay, $endOfDay])->get();
    }

    /**
     * Get total amount of all sales created on given date
     *
     * @param Carbon $date target date
     * @return float
     */
    public function getSOTotalAmountInOneDay($date)
    {
        Log::info("[SalesOrderServiceImpl@getSOInOneDay]");

        $soInGivenDate = $this->getSOInOneDay($date);

        $soTotalAmount = $soInGivenDate->sum(function($so){
            return $so->itemTotalAmount();
        });

        return $soTotalAmount;
    }

    /**
     * Get all sales orders that have not been delivered in more than
     * given threshold days since its shipping date.
     *
     * @param int $threshold threshold in day
     * @return Collection
     */
    public function getUndeliveredSO($threshold = 3)
    {
        Log::info("[SalesOrderServiceImpl@getUndeliveredSO]");

        $salesOrders = SalesOrder::with('customer')
            ->where('status', '=', 'SOSTATUS.WD')
            ->where('shipping_date', '<', Carbon::today()->addDays(-$threshold))
            ->doesntHave('delivers')->get();

        foreach($salesOrders AS $salesOrder)
        {
            $salesOrder->totalAmount = $salesOrder->totalAmount();
        }

        return $salesOrders;
    }

    /**
     * Get all created sales order from given date.
     *
     * @param Carbon
     * @return Collection
     */
    public function getCreatedSOFromDate($date)
    {
        Log::info("[SalesOrderServiceImpl@getCreatedSOFromDate]");

        $startDate = $date->copy()->startOfDay();

        return SalesOrder::where('so_created', '>=', $startDate)->get();
    }

    /**
     * Get all sales order that already delivered but still waiting for customer confirmation.
     *
     * @return Collection
     */
    public function getUncorfirmedSO()
    {
        Log::info("[SalesOrderServiceImpl@getUncorfirmedSO]");

        return SalesOrder::where('status', '=', 'SOSTATUS.WCC')->get();
    }

    public function searchSO($keyword)
    {
        Log::info("[SalesOrderServiceImpl@getUncorfirmedSO]");

        $salesOrders = SalesOrder::with('customer.profiles')
            ->where('code', 'like', '%'.$keyword.'%')
            ->orWhere('walk_in_cust', 'like', '%'.$keyword.'%')
            ->orWhereHas('customer.profiles', function($query) use ($keyword) {
                $query->where('first_name', 'like', '%'.$keyword.'%')
                    ->where('last_name', 'like', '%'.$keyword.'%');
            });

        return $salesOrders;
    }

    public function searchSOByDate($date)
    {
        $date = Carbon::parse($date)->format('Y-m-d');
        
        $saleOrders = SalesOrder::with([ 'customer.profiles', 'delivers.item.product',
            'delivers.item.selectedUnit' => function($q) { $q->with('unit')->withTrashed(); }
        ])
            ->where('so_created', 'like', '%'.$date.'%')->get();

        return $saleOrders;
    }

    public function updateSOStatus(SalesOrder $soData, $amount)
    {
        Log::info("[SalesOrderServiceImpl@updateSOStatus]");

        if ($soData->totalAmountUnpaid() == 0) {
            $soData->status = 'SOSTATUS.C';

            $soData->save();
        }
    }

    public function getTop10Customer()
    {
        Log::info("[SalesOrderServiceImpl@getTop10Customer]");


    }

    public function getTop10WalkInCustomer()
    {
        Log::info("[SalesOrderServiceImpl@getTop10WalkInCustomer]");
    }

    public function getSOByCode($code)
    {
        $saleOrders = SalesOrder::with([ 'customer.profiles' ])
            ->where('code', '=', $code)->get();

        return $saleOrders;
    }

    public function addExpense($id, $expenseArr)
    {
        $currentSo = SalesOrder::whereId($id)->first();

        for($i = 0; $i < count($expenseArr); $i++){
            $expense = new Expense();
            $expense->name = $expenseArr[$i]["expense_name"];
            $expense->type = $expenseArr[$i]["expense_type"];
            $expense->is_internal_expense = !empty($expenseArr[$i]["is_internal_expense"]);
            $expense->amount = floatval(str_replace(',', '', $expenseArr[$i]["expense_amount"]));
            $expense->remarks = $expenseArr[$i]["expense_remarks"];

            $currentSo->expenses()->save($expense);
        }

        $currentSo->save();
    }
}
