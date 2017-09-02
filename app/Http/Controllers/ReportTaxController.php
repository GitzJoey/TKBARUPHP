<?php

namespace App\Http\Controllers;

use App\Model\Tax;
use App\Model\TaxItem;
use App\Model\TaxInput;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportTaxController extends Controller
{
    public function generateTaxReport(Request $request)
    {
        Log::info('ReportTaxController@generateTaxReport');

        $result = [];
        $days = cal_days_in_month(CAL_GREGORIAN, $request->get('month'), $request->get('year'));
        $inputs = TaxInput::where('month', $request->get('month'))
            ->where('year', $request->get('year'))
            ->orderBy('invoice_date', 'asc')
            ->get()->toArray();
        $outputs = Tax::with('transactions')
            ->where('month', $request->get('month'))
            ->where('year', $request->get('year'))
            ->orderBy('invoice_date', 'asc')
            ->get()->toArray();

        for ($i = 1; $i <= $days; $i++) {
            $date = str_pad($i, 2, '0', STR_PAD_LEFT).'-'.str_pad($request->get('month'), 2, '0', STR_PAD_LEFT).'-'.$request->get('year');

            $result[$date] = [];

            foreach ($outputs as $o) {
                if ($o['invoice_date'] == $date) {
                    foreach ($o['transactions'] as $t) {
                        $name = strtoupper($t['name']);

                        $result[$date][$name] = [
                            'qty' => $t['qty'],
                            'price' => $t['price'],
                            'total' => $t['qty'] * $t['price'],
                            'dpp' => $t['qty'] * $t['price'] / 1.1,
                            'ppn' => $t['qty'] * $t['price'] * 0.1
                        ];
                    }
                }
            }
        }

        return $result;
    }
}
