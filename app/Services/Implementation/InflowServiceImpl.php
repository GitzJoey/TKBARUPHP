<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 12/1/2016
 * Time: 10:51 PM
 */

namespace App\Services\Implementation;

use App\Model\Stock;
use App\Model\StockIn;
use App\Model\Receipt;
use App\Model\ProductUnit;
use App\Model\PurchaseOrder;

use App\Services\InflowService;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class InflowServiceImpl implements InflowService
{

    /**
     * Receipt items in a purchase order.
     *
     * @param Request $request request conatining data from receipt form.
     * @param int $poId id of purchase order which item(s) to be received.
     * @return void
     */
    public function createPOReceipt(Request $request, $poId)
    {
        Log::info("[InflowServiceImpl@createPOReceipt]");

        DB::beginTransaction();
        try {
            for ($i = 0; $i < sizeof($request->input('item_id')); $i++) {
                $conversionValue = ProductUnit::where([
                    'product_id' => $request->input("product_id.$i"),
                    'unit_id' => $request->input("selected_unit_id.$i")
                ])->first()->conversion_value;

                $receiptParams = [
                    'receipt_date' => date('Y-m-d', strtotime($request->input('receipt_date'))),
                    'conversion_value' => $conversionValue,
                    'brutto' => $request->input("brutto.$i"),
                    'base_brutto' => $conversionValue * $request->input("brutto.$i"),
                    'netto' => $request->input("netto.$i"),
                    'base_netto' => $conversionValue * $request->input("netto.$i"),
                    'tare' => $request->input("tare.$i"),
                    'base_tare' => $conversionValue * $request->input("tare.$i"),
                    'license_plate' => $request->input('license_plate'),
                    'item_id' => $request->input("item_id.$i"),
                    'selected_unit_id' => $request->input("selected_unit_id.$i"),
                    'base_unit_id' => $request->input("base_unit_id.$i"),
                    'store_id' => Auth::user()->store_id
                ];

                $receipt = Receipt::create($receiptParams);

                $stockParams = [
                    'store_id' => Auth::user()->store_id,
                    'po_id' => $poId,
                    'product_id' => $request->input("product_id.$i"),
                    'warehouse_id' => $request->input('warehouse_id'),
                    'quantity' => $request->input("netto.$i"),
                    'current_quantity' => $request->input("netto.$i")
                ];

                $stock = Stock::create($stockParams);

                $stockInParams = [
                    'store_id' => Auth::user()->store_id,
                    'po_id' => $poId,
                    'product_id' => $request->input("product_id.$i"),
                    'warehouse_id' => $request->input('warehouse_id'),
                    'stock_id' => $stock->id,
                    'quantity' => $request->input("netto.$i")
                ];

                $stockIn = StockIn::create($stockInParams);
            }

            $po = PurchaseOrder::find($poId);
            $po->status = 'POSTATUS.WP';
            $po->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}