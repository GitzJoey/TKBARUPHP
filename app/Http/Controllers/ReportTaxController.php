<?php

namespace App\Http\Controllers;

use App\Model\TaxOutput;
use App\Model\TaxOutputItem;
use App\Model\TaxInput;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportTaxController extends Controller
{
    public function generateTaxReport(Request $request)
    {
        Log::info('ReportTaxController@generateTaxReport');

        $result = [
            'items' => [],
            'data' => []
        ];
        $days = cal_days_in_month(CAL_GREGORIAN, $request->get('month'), $request->get('year'));
        $inputs = TaxInput::where('month', $request->get('month'))
            ->where('year', $request->get('year'))
            ->orderBy('invoice_date', 'asc')
            ->get()->toArray();
        $outputs = TaxOutput::with('transactions')
            ->where('month', $request->get('month'))
            ->where('year', $request->get('year'))
            ->orderBy('invoice_date', 'asc')
            ->get()->toArray();

        foreach ($outputs as $o) {
            foreach ($o['transactions'] as $t) {
                $name = strtoupper($t['name']);
                if (!in_array($name, $result['items'])) {
                    array_push($result['items'], $name);
                }
            }
        }

        $count = count($result['items']);

        for ($i = 1; $i <= $days; $i++) {
            $date = str_pad($i, 2, '0', STR_PAD_LEFT).'-'.str_pad($request->get('month'), 2, '0', STR_PAD_LEFT).'-'.$request->get('year');

            $result['data'][$date] = [];
            for ($c = 1; $c <= $count; $c++) {
                array_push($result['data'][$date], []);
            }

            foreach ($outputs as $o) {
                if ($o['invoice_date'] == $date) {
                    foreach ($o['transactions'] as $k => $t) {
                        $result['data'][$date][$k] = [
                            'qty' => number_format($t['qty']),
                            'price' => number_format($t['price']),
                            'total' => number_format($t['qty'] * $t['price']),
                            'dpp' => number_format($t['qty'] * $t['price'] / 1.1, 2),
                            'ppn' => number_format($t['qty'] * $t['price'] * 0.1)
                        ];
                    }
                }
            }
        }

        return $result;
    }
}
