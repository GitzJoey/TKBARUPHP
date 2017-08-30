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
            $currInv = TaxInput::find($id);

            $pieces = explode("/",$request->input('tax_period'));
            $currInv->invoice_no = $request->input('invoice_no');
            $currInv->invoice_date = $request->input('tax_doc_date');
            $currInv->month = $pieces[0];
            $currInv->year = $pieces[1];
            $currInv->opponent_tax_id_no = $request->input('opponent_tax_id_no');
            $currInv->opponent_name = $request->input('opponent_name');
            $currInv->tax_base = $request->input('tax_base');
            $currInv->gst = $request->input('gst');
            $currInv->luxury_tax = $request->input('luxury_tax');

            $currInv->save();
            return $currInv;

        });
    }
}
