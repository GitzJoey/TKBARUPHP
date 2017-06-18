<?php
/**
 * Created by PhpStorm.
 * User: Rudy Setiady
 * Date: 5/27/2017
 * Time: 3:45 PM
 */

namespace App\Services;
use Doctrine\Common\Collections\Collection;
use Illuminate\Http\Request;

interface TaxInvoiceOutputService
{
    public function createInvoice(Request $request);

    public function getTaxByID($id);

    public function editInvoice(Request $request, $invoiceId);
}