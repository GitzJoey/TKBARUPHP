<?php

namespace App\Services\Implementation;

use App\Model\TaxInput;
use App\Services\TaxInvoiceInputService;
use Illuminate\Http\Request;
use DB;

class TaxInvoiceInputServiceImpl implements TaxInvoiceInputService
{
    public function createInvoice(Request $request) {

        DB::beginTransaction();

        try {

            $pieces = explode("/",$request->input('tax_period'));
            $params = [
                'invoice_no' => $request->input('invoice_no'),
                'invoice_date' => $request->input('tax_doc_date'),
                'month' => $pieces[0],
                'year' => $pieces[1],
                'opponent_tax_id_no' => $request->input('opponent_tax_id_no'),
                'opponent_name' => $request->input('opponent_name'),
                'tax_base' => $request->input('tax_base'),
                'gst' => $request->input('gst'),
                'luxury_tax' => $request->input('luxury_tax'),
            ];

            $tax = TaxInput::create($params);

            DB::commit();

            return $tax;

        } catch (Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function getTaxByID($id)
    {
        // return TaxInput::with('transactions')->find($id);
    }

    public function editInvoice(Request $request, $id)
    {
        DB::transaction(function() use ($id, $request) {

            // Get current Invoice
            // $currInv = TaxInput::with('transactions')->find($id);

            // $invTranId = $currInv->transactions->map(function ($transaction) {
                // return $transaction->id;
            // })->all();

            // $inputtedTranId = $request->input('tran_id');

            // Get the id of removed transactions
            // $invTranToBeDel = array_diff($invTranId, isset($invTranId) ? $inputtedTranId: []);

            // Remove the items transactions that removed on the edit page
            // TaxItem::destroy($invTranToBeDel);

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
            $currInv->gst_type = 'KELUARAN';
            $currInv->tax_base = $request->input('tax_base');
            $currInv->gst = $request->input('gst');
            $currInv->luxury_tax = $request->input('luxury_tax');
            $currInv->reference = $request->input('reference');

            $currInv->save();
            return $currInv;

        });
    }
}
