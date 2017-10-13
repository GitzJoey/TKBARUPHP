<?php

namespace App\Services\Implementation;

use Exception;
use App\Model\TaxInput;
use App\Services\TaxInvoiceInputService;
use Illuminate\Http\Request;
use DB;

class TaxInvoiceInputServiceImpl implements TaxInvoiceInputService
{
    public function createInvoice(Request $request) {
        DB::beginTransaction();
        try {
            $params = [
                'invoice_no' => $request->input('invoice_no'),
                'opponent_tax_id_no' => $request->input('opponent_tax_id_no'),
                'opponent_name' => $request->input('opponent_name'),
                'invoice_date' => $request->input('invoice_date'),
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'is_creditable' => $request->input('is_creditable'),
                'detail' => $request->input('detail'),
                'qty' => $request->input('qty'),
                'unit_price' => $request->input('unit_price'),
                'tax_base' => $request->input('tax_base'),
                'gst' => $request->input('gst'),
                'luxury_tax' => $request->input('luxury_tax'),
            ];

            $tax = TaxInput::create($params);

            DB::commit();

            return $tax;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getTaxByID($id)
    {
        return TaxInput::find($id);
    }

    public function editInvoice(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $params = [
                'invoice_no' => $request->input('invoice_no'),
                'opponent_tax_id_no' => $request->input('opponent_tax_id_no'),
                'opponent_name' => $request->input('opponent_name'),
                'invoice_date' => $request->input('invoice_date'),
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'is_creditable' => $request->input('is_creditable'),
                'detail' => $request->input('detail'),
                'qty' => $request->input('qty'),
                'unit_price' => $request->input('unit_price'),
                'tax_base' => $request->input('tax_base'),
                'gst' => $request->input('gst'),
                'luxury_tax' => $request->input('luxury_tax'),
            ];

            $tax = TaxInput::findOrFail($id);
            $tax->fill($params);
            $tax->save();

            DB::commit();

            return $tax;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
