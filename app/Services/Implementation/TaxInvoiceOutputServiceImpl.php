<?php
/**
 * Created by PhpStorm.
 * User: Rudy Setiady
 * Date: 5/27/2017
 * Time: 3:47 PM
 */

namespace App\Services\Implementation;

use App\Model\TaxOutput;
use App\Model\TaxOutputItem;
use App\Services\TaxInvoiceOutputService;
use Illuminate\Http\Request;
use DB;

class TaxInvoiceOutputServiceImpl implements TaxInvoiceOutputService
{
    public function createInvoice(Request $request) {

        DB::beginTransaction();

        try {

            $pieces = explode("/",$request->input('tax_period'));
            $params = [
                'invoice_no' => $request->input('invoice_no'),
                'invoice_date' => $request->input('tax_doc_date'),
                'gst_transaction_type' => $request->input('gst_transaction_type'),
                'transaction_doc' => $request->input('transaction_doc'),
                'transaction_detail' => $request->input('transaction_detail'),
                'month' => $pieces[0],
                'year' => $pieces[1],
                'tax_id_no' => $request->input('tax_id_no'),
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'opponent_tax_id_no' => $request->input('opponent_tax_id_no'),
                'opponent_name' => $request->input('opponent_name'),
                'opponent_address' => $request->input('opponent_address'),
                'tax_base' => $request->input('tax_base'),
                'gst' => $request->input('gst'),
                'luxury_tax' => $request->input('luxury_tax'),
                'reference' => $request->input('reference'),
            ];

            $tax = TaxOutput::create($params);

            for($i = 0; $i < count($request->input('tran_name')); $i++){
                $taxItem = new TaxOutputItem();
                $taxItem->name = $request->input("tran_name.$i");
                $taxItem->is_gst_included = boolval($request->input("tran_is_gst_included.$i"));
                $taxItem->price = $request->input("tran_price.$i");
                $taxItem->discount = $request->input("tran_discount.$i");
                $taxItem->qty = $request->input("tran_qty.$i");
                $taxItem->gst = $request->input("tran_gst.$i");
                $taxItem->luxury_tax = $request->input("tran_luxury_tax.$i");
                $tax->transactions()->save($taxItem);
            }

            DB::commit();

            return $tax;

        } catch (Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function getTaxByID($id)
    {
        return TaxOutput::with('transactions')->find($id);
    }

    public function editInvoice(Request $request, $id)
    {
        DB::transaction(function() use ($id, $request) {

            // Get current Invoice
            $currInv = TaxOutput::with('transactions')->find($id);

            $invTranId = $currInv->transactions->map(function ($transaction) {
                return $transaction->id;
            })->all();

            $inputtedTranId = $request->input('tran_id');

            // Get the id of removed transactions
            $invTranToBeDel = array_diff($invTranId, isset($invTranId) ? $inputtedTranId: []);

            // Remove the items transactions that removed on the edit page
            TaxOutputItem::destroy($invTranToBeDel);

            $pieces = explode("/",$request->input('tax_period'));
            $currInv->invoice_no = $request->input('invoice_no');
            $currInv->invoice_date = $request->input('tax_doc_date');
            $currInv->gst_transaction_type = $request->input('gst_transaction_type');
            $currInv->transaction_doc = $request->input('transaction_doc');
            $currInv->transaction_detail = $request->input('transaction_detail');
            $currInv->month = $pieces[0];
            $currInv->year = $pieces[1];
            $currInv->tax_id_no = $request->input('tax_id_no');
            $currInv->name = $request->input('name');
            $currInv->address = $request->input('address');
            $currInv->opponent_tax_id_no = $request->input('opponent_tax_id_no');
            $currInv->opponent_name = $request->input('opponent_name');
            $currInv->opponent_address = $request->input('opponent_address');
            $currInv->tax_base = $request->input('tax_base');
            $currInv->gst = $request->input('gst');
            $currInv->luxury_tax = $request->input('luxury_tax');
            $currInv->reference = $request->input('reference');

            for($i = 0; $i < count($request->input('tran_id')); $i++){
                $tran = TaxOutputItem::findOrNew($request->input("tran_id.$i"));
                $tran->name = $request->input("tran_name.$i");
                $tran->is_gst_included = boolval($request->input("tran_is_gst_included.$i"));
                $tran->price = $request->input("tran_price.$i");
                $tran->discount = $request->input("tran_discount.$i");
                $tran->qty = $request->input("tran_qty.$i");
                $tran->gst = $request->input("tran_gst.$i");
                $tran->luxury_tax = $request->input("tran_luxury_tax.$i");
                $currInv->transactions()->save($tran);
            }

            $currInv->save();
            return $currInv;

        });
    }
}
