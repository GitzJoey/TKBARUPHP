<?php
/**
 * Created by PhpStorm.
 * User: Rudy Setiady
 * Date: 5/27/2017
 * Time: 3:47 PM
 */

namespace App\Services\Implementation;

use App\Model\Tax;
use App\Model\TaxItem;
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
                'gst_type' => 'KELUARAN',
                'tax_base' => $request->input('tax_base'),
                'gst' => $request->input('gst'),
                'luxury_tax' => $request->input('luxury_tax'),
                'reference' => $request->input('reference'),
            ];

            $tax = Tax::create($params);

            for($i = 0; $i < count($request->input('tran_name')); $i++){
                $taxItem = new TaxItem();
                $taxItem->name = $request->input("tran_name.$i");
                $taxItem->is_gst_included = boolval($request->input("tran_is_gst_included.$i"));
                $taxItem->price = $request->input("tran_price.$i");
                $taxItem->discount = $request->input("tran_discount.$i");
                $taxItem->qty = $request->input("tran_qty.$i");
                $taxItem->gst = $request->input("tran_gst.$i");
                $taxItem->luxury_tax = $request->input("tran_luxury_tax.$i");
                $tax->items()->save($taxItem);
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
        return Tax::find($id);
    }
}
