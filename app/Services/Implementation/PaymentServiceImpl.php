<?php
namespace App\Services\Implementation;

use App\Model\CashPayment;
use App\Model\Giro;
use App\Model\GiroPayment;
use App\Model\Lookup;
use App\Model\Payment;
use App\Model\TransferPayment;
use App\Services\PaymentService;

use Illuminate\Http\Request;

class PaymentServiceImpl implements PaymentService {

    public function createCashPayment(Request $request)
    {
        $paymentParam = [
            'payment_date' => date('Y-m-d', strtotime($request->input('payment_date'))),
            'total_amount' => floatval(str_replace(',', '', $request->input('total_amount'))),
            'status' => 'CASHPAYMENTSTATUS.C',
            'type' => 'PAYMENTTYPE.C'
        ];

        $payment = Payment::create($paymentParam);

        $cashPayment = new CashPayment();
        $cashPayment->save();
        $cashPayment->payment()->save($payment);

        return $payment;
    }

    public function createTransferPayment(Request $request)
    {
        $paymentParam = [
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
        $paymentParam = [
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
}
