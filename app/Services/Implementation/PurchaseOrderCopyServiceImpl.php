<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 12/3/2016
 * Time: 6:49 PM
 */

namespace App\Services\Implementation;

use App\Model\Item;
use App\Model\Expense;
use App\Model\ProductUnit;
use App\Model\PurchaseOrder;
use App\Model\PurchaseOrderCopy;

use App\Services\PurchaseOrderCopyService;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Doctrine\Common\Collections\Collection;

class PurchaseOrderCopyServiceImpl implements PurchaseOrderCopyService
{

    /**
     * Get all copies of purchase order with given code.
     *
     * @param string $poCode code of purchase order.
     * @return Collection copies of purchase order.
     */
    public function getCopiesOfPO($poCode)
    {
        return PurchaseOrderCopy::where('main_po_code', '=', $poCode)->get();
    }

    /**
     * Create a copy of purchase order. Created copy will be returned.
     *
     * @param Request $request request containing data for creating the copy of purchase order.
     * @param string $poCode code of purchase order to be copied.
     * @return PurchaseOrderCopy copy of purchase order.
     */
    public function createPOCopy(Request $request, $poCode)
    {
        DB::transaction(function() use ($request, $poCode) {
            $poToBeCopied = PurchaseOrder::whereCode($poCode)->first();

            $params = [
                'code' => strtoupper($request->input('code')),
                'remarks' => $request->input('remarks'),
                'main_po_id' => $poToBeCopied->id,
                'main_po_code' => $poToBeCopied->code,
                'main_po_remarks' => $poToBeCopied->remarks,
                'po_type' => $poToBeCopied->po_type,
                'po_created' => $poToBeCopied->po_created,
                'shipping_date' => $poToBeCopied->shipping_date,
                'supplier_type' => $poToBeCopied->supplier_type,
                'walk_in_supplier' => $poToBeCopied->walk_in_supplier,
                'walk_in_supplier_detail' => $poToBeCopied->walk_in_supplier_detail,
                'status' => $poToBeCopied->status,
                'supplier_id' => $poToBeCopied->supplier_id,
                'vendor_trucking_id' => $poToBeCopied->vendor_trucking_id,
                'warehouse_id' => $poToBeCopied->warehouse_id,
                'store_id' => $poToBeCopied->store_id
            ];

            $poCopy = PurchaseOrderCopy::create($params);

            for ($i = 0; $i < count($request->input('product_id')); $i++) {
                $item = new Item();
                $item->product_id = $request->input("product_id.$i");
                $item->store_id =  $poToBeCopied->store_id;
                $item->selected_unit_id = $request->input("selected_unit_id.$i");
                $item->base_unit_id = $request->input("base_unit_id.$i");
                $item->conversion_value = ProductUnit::whereId($item->selected_unit_id)->first()->conversion_value;
                $item->quantity = $request->input("quantity.$i");
                $item->price = floatval(str_replace(',', '', $request->input("price.$i")));
                $item->to_base_quantity = $item->quantity * $item->conversion_value;

                $poCopy->items()->save($item);
            }

            return $poCopy;
        });
    }

    /**
     * Get a copy of purchase order to be edited.
     *
     * @param int $id id of copy of purchase order.
     * @return PurchaseOrderCopy
     */
    public function getPOCopyForEdit($id)
    {
        return PurchaseOrderCopy::with('items.product.productUnits.unit', 'supplier.profiles.phoneNumbers.provider',
            'supplier.bankAccounts.bank', 'supplier.products.productUnits.unit', 'supplier.products.type',
            'supplier.expenseTemplates', 'vendorTrucking', 'warehouse')->find($id);
    }

    /**
     * Edit a copy of purchase order. Edited copy of purchase order will be returned.
     *
     * @param Request $request request that contains values from edit form.
     * @param int $poCopyId id of copy of purchase order.
     * @return PurchaseOrderCopy
     */
    public function editPOCopy(Request $request, $poCopyId)
    {
        DB::transaction(function() use ($poCopyId, $request) {
            // Get current PO Copy
            $currentPoCopy = PurchaseOrderCopy::with('items')->find($poCopyId);

            // Get IDs of current PO Copy's items
            $poCopyItemsId = $currentPoCopy->items->map(function ($item) {
                return $item->id;
            })->all();

            $inputtedItemId = $request->input('item_id');

            // Get the id of removed items
            $poCopyItemsToBeDeleted = array_diff($poCopyItemsId, isset($inputtedItemId) ? $inputtedItemId : []);

            // Remove the items that removed on the revise page
            Item::destroy($poCopyItemsToBeDeleted);

            $currentPoCopy->remarks = $request->input('remarks');

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

                $currentPoCopy->items()->save($item);
            }

            $currentPoCopy->save();

            return $currentPoCopy;
        });
    }
}