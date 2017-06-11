<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 12/5/2016
 * Time: 9:57 PM
 */

namespace App\Services\Implementation;

use App\Model\Item;
use App\Model\SalesOrder;
use App\Model\ProductUnit;
use App\Model\SalesOrderCopy;

use App\Services\SalesOrderCopyService;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Doctrine\Common\Collections\Collection;

class SalesOrderCopyServiceImpl implements SalesOrderCopyService
{
    /**
     * Get all copies of sales order with given code.
     *
     * @param string $soCode code of sales order.
     * @return Collection copies of sales order.
     */
    public function getCopiesOfSO($soCode)
    {
        return SalesOrderCopy::where('main_so_code', '=', $soCode);
    }

    /**
     * Create a copy of sales order. Created copy will be returned.
     *
     * @param Request $request request containing data for creating the copy of sales order.
     * @param string $soCode code of sales order to be copied.
     * @return SalesOrderCopy copy of sales order.
     */
    public function createSOCopy(Request $request, $soCode)
    {
        DB::transaction(function() use ($request, $soCode) {
            $soToBeCopied = SalesOrder::whereCode($soCode)->first();

            $params = [
                'code' => strtoupper($request->input('code')),
                'remarks' => $request->input('remarks'),
                'main_so_id' => $soToBeCopied->id,
                'main_so_code' => $soToBeCopied->code,
                'main_so_remarks' => $soToBeCopied->remarks,
                'so_type' => $soToBeCopied->so_type,
                'so_created' => $soToBeCopied->so_created,
                'shipping_date' => $soToBeCopied->shipping_date,
                'customer_type' => $soToBeCopied->customer_type,
                'walk_in_cust' => $soToBeCopied->walk_in_cust,
                'walk_in_cust_detail' => $soToBeCopied->walk_in_cust_detail,
                'status' => $soToBeCopied->status,
                'customer_id' => $soToBeCopied->customer_id,
                'vendor_trucking_id' => $soToBeCopied->vendor_trucking_id,
                'warehouse_id' => $soToBeCopied->warehouse_id,
                'store_id' => $soToBeCopied->store_id
            ];

            $soCopy = SalesOrderCopy::create($params);

            for ($i = 0; $i < count($request->input('product_id')); $i++) {
                $item = new Item();
                $item->product_id = $request->input("product_id.$i");
                $item->store_id =  $soToBeCopied->store_id;
                $item->selected_unit_id = $request->input("selected_unit_id.$i");
                $item->base_unit_id = $request->input("base_unit_id.$i");
                $item->conversion_value = ProductUnit::whereId($item->selected_unit_id)->first()->conversion_value;
                $item->quantity = $request->input("quantity.$i");
                $item->price = floatval(str_replace(',', '', $request->input("price.$i")));
                $item->to_base_quantity = $item->quantity * $item->conversion_value;

                $soCopy->items()->save($item);
            }

            return $soCopy;
        });
    }

    /**
     * Get a copy of sales order to be edited.
     *
     * @param int $id id of copy of sales order.
     * @return SalesOrderCopy
     */
    public function getSOCopyForEdit($id)
    {
        return SalesOrderCopy::with('items.product.productUnits.unit', 'customer.profiles.phoneNumbers.provider',
            'customer.bankAccounts.bank', 'vendorTrucking', 'warehouse')->find($id);
    }

    /**
     * Edit a copy of sales order. Edited copy of sales order will be returned.
     *
     * @param Request $request request that contains values from edit form.
     * @param int $soCopyId id of copy of sales order.
     * @return SalesOrderCopy
     */
    public function editSOCopy(Request $request, $soCopyId)
    {
        DB::transaction(function() use ($request, $soCopyId) {
            // Get current SO Copy
            $currentSoCopy = SalesOrderCopy::with('items')->find($soCopyId);

            // Get IDs of current SO Copy's items
            $soCopyItemsId = $currentSoCopy->items->map(function ($item) {
                return $item->id;
            })->all();

            $inputtedItemId = $request->input('item_id');

            // Get the id of removed items
            $soCopyItemsToBeDeleted = array_diff($soCopyItemsId, isset($inputtedItemId) ? $inputtedItemId : []);

            // Remove the items that removed on the revise page
            Item::destroy($soCopyItemsToBeDeleted);

            $currentSoCopy->remarks = $request->input('remarks');

            for ($i = 0; $i < count($request->input('item_id')); $i++) {
                $item = Item::findOrNew($request->input("item_id.$i"));
                $item->product_id = $request->input("product_id.$i");
                $item->store_id = Auth::user()->store_id;
                $item->selected_unit_id = $request->input("selected_unit_id.$i");
                $item->base_unit_id = $request->input("base_unit_id.$i");
                $item->conversion_value = ProductUnit::whereId($item->selected_unit_id)->first()->conversion_value;
                $item->quantity = $request->input("quantity.$i");
                $item->price = floatval(str_replace(',', '', $request->input("price.$i")));
                $item->to_base_quantity = $item->quantity * $item->conversion_value;

                $currentSoCopy->items()->save($item);
            }

            $currentSoCopy->save();

            return $currentSoCopy;
        });
    }
}