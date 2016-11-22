<?php

namespace App\Services\Implementation;

use App\Model\Item;
use App\Model\Lookup;
use App\Model\ProductUnit;
use App\Model\PurchaseOrder;
use App\Services\PurchaseOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Created by PhpStorm.
 * User: miftah.fathudin
 * Date: 11/13/2016
 * Time: 2:26 AM
 */
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
            'status' => Lookup::whereCode('POSTATUS.WA')->first()->code,
            'supplier_id' => $supplier_id,
            'vendor_trucking_id' => empty($request->input('vendor_trucking_id')) ? 0 : $request->input('vendor_trucking_id'),
            'warehouse_id' => $request->input('warehouse_id'),
            'store_id' => Auth::user()->store_id
        ];

        $po = PurchaseOrder::create($params);

        for ($i = 0; $i < count($request->input('product_id')); $i++) {
            $item = new Item();
            $item->product_id = $request->input("product_id.$i");
            $item->store_id = Auth::user()->store_id;
            $item->selected_unit_id = $request->input("selected_unit_id.$i");
            $item->base_unit_id = $request->input("base_unit_id.$i");
            $item->conversion_value = ProductUnit::where([
                'product_id' => $item->product_id,
                'unit_id' => $item->selected_unit_id
            ])->first()->conversion_value;
            $item->quantity = $request->input("quantity.$i");
            $item->price = floatval(str_replace(',', '', $request->input("price.$i")));
            $item->to_base_quantity = $item->quantity * $item->conversion_value;

            $po->items()->save($item);
        }

        return $po;
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
        // Get current PO
        $currentPo = PurchaseOrder::with('items')->find($id);

        // Get ID of current PO's items
        $poItemsId = $currentPo->items->map(function ($item) {
            return $item->id;
        })->all();

        // Get the id of removed items
        $poItemsToBeDeleted = array_diff($poItemsId, $request->input('item_id'));

        // Remove the item that removed on the revise page
        Item::destroy($poItemsToBeDeleted);

        $currentPo->shipping_date = date('Y-m-d H:i:s', strtotime($request->input('shipping_date')));
        $currentPo->warehouse_id = $request->input('warehouse_id');
        $currentPo->vendor_trucking_id = empty($request->input('vendor_trucking_id')) ? 0 : $request->input('vendor_trucking_id');
        $currentPo->remarks = $request->input('remarks');

        for ($i = 0; $i < count($request->input('item_id')); $i++) {
            $item = Item::findOrNew($request->input("item_id.$i"));
            $item->product_id = $request->input("product_id.$i");
            $item->store_id = Auth::user()->store_id;
            $item->selected_unit_id = $request->input("selected_unit_id.$i");
            $item->base_unit_id = $request->input("base_unit_id.$i");
            $item->conversion_value = ProductUnit::where([
                'product_id' => $item->product_id,
                'unit_id' => $item->selected_unit_id
            ])->first()->conversion_value;
            $item->quantity = $request->input("quantity.$i");
            $item->price = floatval(str_replace(',', '', $request->input("price.$i")));
            $item->to_base_quantity = $item->quantity * $item->conversion_value;

            $currentPo->items()->save($item);
        }

        $currentPo->save();

        return $currentPo;
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
}