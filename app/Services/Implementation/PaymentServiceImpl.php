<?php
namespace App\Services\Implementation;

use App\Model\Giro;
use App\Model\Payment;
use App\Model\CashPayment;
use App\Model\GiroPayment;
use App\Model\TransferPayment;

use App\Services\PaymentService;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentServiceImpl implements PaymentService {

    public function createCashPayment($payable, $paymentDate, $paymentAmount)
    {
        Log::info("[PaymentServiceImpl@createCashPayment]");

        DB::transaction(function() use ($payable, $paymentDate, $paymentAmount){
            $payment = $this->createBasicPayment($paymentDate, $paymentAmount, 'CASHPAYMENTSTATUS.C', 'PAYMENTTYPE.C');

            $cashPayment = new CashPayment();
            $cashPayment->save();
            $cashPayment->payment()->save($payment);

            $payable->payments()->save($payment);

            return $payment;
        });
    }

    public function createTransferPayment(Request $request)
    {
        Log::info("[PaymentServiceImpl@createTransferPayment]");

        $paymentParam = [
            'store_id' => Auth::user()->store_id,
            'payment_date' => date('Y-m-d', strtotime($request->input('payment_date'))),
            'total_amount' => floatval(str_replace(',', '', $request->input('total_amount'))),
            'status' => 'TRFPAYMENTSTATUS.UNCONFIRMED',
            'type' => 'PAYMENTTYPE.T'
        ];
        $payment = Payment::create($paymentParam);

        $transferPayment = new TransferPayment();
        $transferPayment->bank_account_from_id = empty($request->input('bank_account_from')) ? 0 : $request->input('bank_account_from');
        $transferPayment->bank_account_to_id = empty($request->input('bank_account_to')) ? 0 : $request->input('bank_account_to');
        $transferPayment->effective_date = date('Y-m-d', strtotime($request->input('effective_date')));
        $transferPayment->save();
        $transferPayment->payment()->save($payment);

        return $payment;
    }

    public function createGiroPayment(Request $request, Giro $giro)
    {
        Log::info("[PaymentServiceImpl@createGiroPayment]");

        $paymentParam = [
            'store_id' => Auth::user()->store_id,
            'payment_date' => date('Y-m-d', strtotime($request->input('payment_date'))),
            'total_amount' => floatval(str_replace(',', '', $request->input('amount'))),
            'status' => 'GIROPAYMENTSTATUS.WE',
            'type' => 'PAYMENTTYPE.G'
        ];
        
        $payment = Payment::create($paymentParam);

        $giroPayment = new GiroPayment();
        $giroPayment->giro_id = $giro->id;
        $giroPayment->save();
        $giroPayment->payment()->save($payment);

        return $payment;
    }

    private function createBasicPayment($paymentDate, $paymentAmount, $paymentStatus, $paymentType)
    {
        $paymentParam = [
            'store_id' => Auth::user()->store_id,
            'payment_date' => $paymentDate,
            'total_amount' => $paymentAmount,
            'status' => $paymentStatus,
            'type' => $paymentType
        ];

        return Payment::create($paymentParam);
    }

    public function searchPayment($keyword)
    {

    }
}
