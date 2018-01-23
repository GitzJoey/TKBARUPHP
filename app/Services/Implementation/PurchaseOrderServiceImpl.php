<?php
/**
 * Created by PhpStorm.
 * User: miftah.fathudin
 * Date: 11/13/2016
 * Time: 2:26 AM
 */

namespace App\Services\Implementation;

use App\Model\Item;
use App\Model\Lookup;
use App\Model\Expense;
use App\Model\ProductUnit;
use App\Model\PurchaseOrder;
use App\Model\ItemDiscounts;
use App\Services\PurchaseOrderService;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Doctrine\Common\Collections\Collection;

class PurchaseOrderServiceImpl implements PurchaseOrderService
{
    /**
     * Save(create) a newly purchase order. The saved(created) purchase order will be returned.
     *
     * @param Request $request request which contains values from create form to create the purchase order.
     * @return PurchaseOrder
     */
    public function createPO(Request $request)
    {
        DB::beginTransaction();

        try {
            if ($request->input('supplier_type') == 'SUPPLIERTYPE.R'){
                $supplier_id = empty($request->input('supplier_id')) ? 0 : $request->input('supplier_id');
                $walk_in_supplier = '';
                $walk_in_supplier_detail = '';
            } else {
                $supplier_id = 0;
                $walk_in_supplier = $request->input('walk_in_supplier');
                $walk_in_supplier_detail = $request->input('walk_in_supplier_detail');
            }

            $params = [
                'code' => $request->input('code'),
                'po_type' => $request->input('po_type'),
                'po_created' => date('Y-m-d H:i:s', strtotime($request->input('po_created'))),
                'shipping_date' => date('Y-m-d H:i:s', strtotime($request->input('shipping_date'))),
                'supplier_type' => $request->input('supplier_type'),
                'walk_in_supplier' => $walk_in_supplier,
                'walk_in_supplier_detail' => $walk_in_supplier_detail,
                'remarks' => $request->input('remarks'),
                'internal_remarks' => $request->input('internal_remarks'),
                'private_remarks' => $request->input('private_remarks'),
                'status' => Lookup::whereCode('POSTATUS.WA')->first()->code,
                'supplier_id' => $supplier_id,
                'vendor_trucking_id' => empty($request->input('vendor_trucking_id')) ? 0 : $request->input('vendor_trucking_id'),
                'warehouse_id' => $request->input('warehouse_id'),
                'store_id' => Auth::user()->store_id,
                'disc_percent' => $request->input('disc_total_percent'),
                'disc_value' => $request->input('disc_total_value'),
            ];

            $po = PurchaseOrder::create($params);

            for ($i = 0; $i < count($request->input('item_product_id')); $i++) {
                $item = new Item();
                $item->product_id = $request->input("item_product_id.$i");
                $item->store_id = Auth::user()->store_id;
                $item->selected_unit_id = $request->input("item_selected_unit_id.$i");
                $item->base_unit_id = $request->input("base_unit_id.$i");
                $item->conversion_value = ProductUnit::whereId($item->selected_unit_id)->first()->conversion_value;
                $item->quantity = $request->input("item_quantity.$i");
                $item->price = floatval(str_replace(',', '', $request->input("item_price.$i")));
                $item->to_base_quantity = $item->quantity * $item->conversion_value;

                $item_saved = $po->items()->save($item);

                for ($ia = 0; $ia < count($request->input('item_disc_percent.'.$i)); $ia++) {
                    if( $request->input('item_disc_percent.'.$i.'.'.$ia) > 0 ){
                        $itemDiscounts = new ItemDiscounts();
                        $itemDiscounts->item_disc_percent = $request->input('item_disc_percent.'.$i.'.'.$ia);
                        $itemDiscounts->item_disc_value = $request->input('item_disc_value.'.$i.'.'.$ia);
                        $item_saved->discounts()->save($itemDiscounts);
                    }
                }
            }

            for($i = 0; $i < count($request->input('expense_name')); $i++){
                $expense = new Expense();
                $expense->name = $request->input("expense_name.$i");
                $expense->type = $request->input("expense_type.$i");
                $expense->is_internal_expense = !empty($request->input("is_internal_expense.$i"));
                $expense->amount = floatval(str_replace(',', '', $request->input("expense_amount.$i")));
                $expense->remarks = $request->input("expense_remarks.$i");
                $po->expenses()->save($expense);
            }

            DB::commit();

            return $po;
        } catch (Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * Get purchase order to be revised.
     *
     * @param int $id id of purchase order to be revised.
     * @return PurchaseOrder purchase order to be revised.
     */
    public function getPOForRevise($id)
    {
        return PurchaseOrder::with('items.product.productUnits.unit', 'items.discounts', 'supplier.profiles.phoneNumbers.provider',
            'supplier.bankAccounts.bank', 'supplier.products.productUnits.unit', 'supplier.products.type',
            'supplier.expenseTemplates', 'vendorTrucking', 'warehouse', 'expenses')->find($id);
    }

    /**
     * Revise(modify) a purchase order. If the purchase order is still waiting for arrival, it's warehouse,
     * vendor trucking, shipping date and items can be changed. But, if it is already waiting for payment,
     * only it's items price can be changed. The revised(modified) purchase order will be returned.
     *
     * @param Request $request request which contains values from revise form to revise the purchase order.
     * @param int $id the id of purchase order to be revised.
     * @return PurchaseOrder
     */
    public function revisePO(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Get current PO
            $currentPo = PurchaseOrder::with('items')->find($id);

            // Get IDs of current PO's items
            $poItemsId = $currentPo->items->map(function ($item) {
                return $item->id;
            })->all();

            $inputtedItemId = $request->input('item_id');

            // Get the id of removed items
            $poItemsToBeDeleted = array_diff($poItemsId, isset($inputtedItemId) ? $inputtedItemId : []);

            // Remove the items that removed on the revise page
            Item::destroy($poItemsToBeDeleted);

            $currentPo->shipping_date = date('Y-m-d H:i:s', strtotime($request->input('shipping_date')));
            $currentPo->warehouse_id = $request->input('warehouse_id');
            $currentPo->vendor_trucking_id = empty($request->input('vendor_trucking_id')) ? 0 : $request->input('vendor_trucking_id');
            $currentPo->remarks = $request->input('remarks');
            $currentPo->internal_remarks = $request->input('internal_remarks');
            $currentPo->private_remarks = $request->input('private_remarks');
            $currentPo->disc_percent = $request->input('disc_total_percent');
            $currentPo->disc_value = $request->input('disc_total_value');

            for ($i = 0; $i < count($request->input('item_id')); $i++) {
                $item = Item::findOrNew($request->input("item_id.$i"));
                $item->product_id = $request->input("item_product_id.$i");
                $item->store_id = Auth::user()->store_id;
                $item->selected_unit_id = $request->input("item_selected_unit_id.$i");
                $item->base_unit_id = $request->input("base_unit_id.$i");
                $item->conversion_value = ProductUnit::whereId($item->selected_unit_id)->first()->conversion_value;
                $item->quantity = $request->input("item_quantity.$i");
                $item->price = floatval(str_replace(',', '', $request->input("item_price.$i")));
                $item->to_base_quantity = $item->quantity * $item->conversion_value;
                $currentPo->items()->save($item);

                // Get IDs of current PO's item discount
                $itemDiscountsId = $item->discounts->map(function ($discount) {
                    return $discount->id;
                })->all();

                $inputtedItemDiscountId = $request->input('item_discount_id.'.$i);

                // Get the id of removed item discount
                $itemDiscountsToBeDeleted = array_diff($itemDiscountsId, isset($inputtedItemDiscountId) ? $inputtedItemDiscountId : []);

                // Remove the item discount that removed on the revise page
                ItemDiscounts::destroy($itemDiscountsToBeDeleted);

                for ($ia = 0; $ia < count($request->input('item_disc_percent.'.$i)); $ia++) {
                    if( $request->input('item_disc_percent.'.$i.'.'.$ia) > 0 ){
                        $itemDiscounts = ItemDiscounts::findOrNew($request->input('item_discount_id.'.$i.'.'.$ia));
                        $itemDiscounts->item_disc_percent = $request->input('item_disc_percent.'.$i.'.'.$ia);
                        $itemDiscounts->item_disc_value = $request->input('item_disc_value.'.$i.'.'.$ia);
                        $item->discounts()->save($itemDiscounts);
                    }
                }
            }

            // Get IDs of current PO's expenses
            $poExpensesId = $currentPo->expenses->map(function ($expense) {
                return $expense->id;
            })->all();

            $inputtedExpenseId = $request->input('expense_id');

            // Get the id of removed expenses
            $poExpensesToBeDeleted = array_diff($poExpensesId, isset($inputtedExpenseId) ? $inputtedExpenseId : []);

            // Remove the expenses that removed on the revise page
            Expense::destroy($poExpensesToBeDeleted);

            for($i = 0; $i < count($request->input('expense_id')); $i++){
                $expense = Expense::findOrNew($request->input("expense_id.$i"));
                $expense->name = $request->input("expense_name.$i");
                $expense->type = $request->input("expense_type.$i");
                $expense->is_internal_expense = !empty($request->input("is_internal_expense.$i"));
                $expense->amount = floatval(str_replace(',', '', $request->input("expense_amount.$i")));
                $expense->remarks = $request->input("expense_remarks.$i");

                $currentPo->expenses()->save($expense);
            }

            $currentPo->save();

            DB::commit();

            return $currentPo;
        } catch (Exception $exception) {
            DB::rollBack();

            return null;
        }
    }

    /**
     * Reject a purchase order. Only purchase orders with status waiting for arrival can be rejected.
     *
     * @param Request $request request which contains values for purchase order rejection.
     * @param int $id the id of purchase order to be rejected.
     * @return void
     */
    public function rejectPO(Request $request, $id)
    {
        $po = PurchaseOrder::find($id);
        $po->status = 'POSTATUS.RJT';
        $po->save();
    }

    /**
     * Get purchase order which items want to be received.
     *
     * @param int $poId id of purchase order which items want to be received.
     * @return PurchaseOrder purchase order which items want to be received.
     */
    public function getPOForReceipt($poId)
    {
        return PurchaseOrder::with('items.product.productUnits.unit', 'receipts')->find($poId);
    }

    /**
     * Get all purchase order which belongs to warehouse with given id.
     *
     * @param int $warehouseId id of warehouse owning the purchase order(s).
     * @return Collection purchase orders of given warehouse.
     */
    public function getWarehousePO($warehouseId)
    {
        return PurchaseOrder::with('supplier')
            ->where('status', '=', 'POSTATUS.WA')
            ->where('warehouse_id', '=', $warehouseId)
            ->get();
    }

    /**
     * Get a purchase order with it's details related to payment.
     *
     * @param int $poId id of purchase order.
     * @return PurchaseOrder
     */
    public function getPOForPayment($poId)
    {
        return PurchaseOrder::with('payments', 'items.product.productUnits.unit', 'items.discounts',
            'supplier.profiles.phoneNumbers.provider', 'supplier.bankAccounts.bank', 'supplier.products',
            'supplier.products.type', 'supplier.expenseTemplates', 'vendorTrucking', 'warehouse', 'expenses')->find($poId);
    }

    /**
     * Get purchase order to be copied.
     *
     * @param string $poCode code of purchase order to be copied.
     * @return PurchaseOrder
     */
    public function getPOForCopy($poCode)
    {
        return PurchaseOrder::with('items.product.productUnits.unit', 'supplier.profiles.phoneNumbers.provider',
            'supplier.bankAccounts.bank', 'supplier.products.productUnits.unit', 'supplier.products.type',
            'supplier.expenseTemplates', 'vendorTrucking', 'warehouse')->where('code', '=', $poCode)->first();
    }

    /**
     * Get a collection of purchase orders that almost due for payment.
     *
     * @param int $daysToDue number of days before the purchase order must be paid.
     * @return Collection purchase order that due for payment.
     */
    public function getDuePO($daysToDue = 1)
    {
        $poWaitingForPayment = PurchaseOrder::with('receipts', 'supplier')
            ->where('status', '=', 'POSTATUS.WP')
            ->whereHas('supplier', function($query){
                $query->where('payment_due_day', '>', 0);
        })->get();

        $today = Carbon::today();

        $duePO = $poWaitingForPayment->filter(function($po, $key) use ($daysToDue, $today){
            $supplierPaymentDueDay = $po->supplier->payment_due_day;
            return $today->gte($po->receipts->first()->receipt_date->addDays($supplierPaymentDueDay - $daysToDue));
        });

        return $duePO;
    }

     /**
     * Get all purchase orders that have not been received in more than
     * given threshold days since its shipping date.
     *
     * @param int $threshold threshold in day
     * @return Collection
     */
    public function getUnreceivedPO($threshold = 3)
    {
        $purchaseOrders = PurchaseOrder::with('supplier')
            ->where('status', '=', 'POSTATUS.WA')
            ->where('shipping_date', '<', Carbon::today()->addDays(-$threshold))
            ->doesntHave('receipts')->get();

        foreach($purchaseOrders AS $purchaseOrder)
        {
            $purchaseOrder->totalAmount = $purchaseOrder->totalAmount();
        }

        return $purchaseOrders;
    }

    public function searchPO($keyword)
    {
        $purchaseOrders = PurchaseOrder::with('supplier.profiles')
            ->where('code', 'like', '%'.$keyword.'%')
            ->orWhereHas('supplier.profiles', function($query) use ($keyword) {
                $query->where('first_name', 'like', '%'.$keyword.'%')
                    ->where('last_name', 'like', '%'.$keyword.'%');
            });

        return $purchaseOrders;
    }

    public function searchPOByDate($date)
    {
        $date = Carbon::parse($date)->format('Y-m-d');

        $purchaseOrders = PurchaseOrder::with([ 'items.product', 'supplier.profiles', 'receipts.item.product',
            'receipts.item.selectedUnit' => function($q) { $q->with('unit')->withTrashed(); }
        ])
            ->where('po_created', 'like', '%'.$date.'%')->get();

        return $purchaseOrders;
    }

    public function updatePOStatus(PurchaseOrder $poData, $amount)
    {
        if (($amount + $poData->totalAmountPaid()) === $poData->totalAmount()) {
            $poData->status = 'POSTATUS.C';

            $poData->save();
        }
    }

    public function getLastPODates($limit = 50)
    {
        $po = PurchaseOrder::all()->groupBy(function ($po) {
            return $po->po_created->format('d-M-y');
        })->take($limit)->map(function($item) {
            return $item->all()[0]->po_created->format('d/m/y');
        });

        return $po;
    }

    public function getPOByCode($code)
    {
        return PurchaseOrder::with('supplier')
            ->where('code', '=', $code)
            ->get();
    }

    public function addExpenses($poId, $expenseArr)
    {
        $currentPo = PurchaseOrder::whereId($poId)->first();

        for($i = 0; $i < count($expenseArr); $i++){
            $expense = new Expense();
            $expense->name = $expenseArr[$i]["expense_name"];
            $expense->type = $expenseArr[$i]["expense_type"];
            $expense->is_internal_expense = !empty($expenseArr[$i]["is_internal_expense"]);
            $expense->amount = floatval(str_replace(',', '', $expenseArr[$i]["expense_amount"]));
            $expense->remarks = $expenseArr[$i]["expense_remarks"];

            $currentPo->expenses()->save($expense);
        }

        $currentPo->save();
    }
}
