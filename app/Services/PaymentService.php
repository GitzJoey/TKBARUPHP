<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 12/1/2016
 * Time: 11:42 PM
 */

namespace App\Services;

use App\Model\Giro;
use Illuminate\Http\Request;

interface PaymentService
{
    /**
     * Make a cash payment for given payable.
     *
     * @param mixed $payable payable object (SalesOrder and PurchaseOrder). *Should be bounded to an interface later
     * @param mixed $paymentDate date of payment.
     * @param float $paymentAmount amount of payment.
     * @return Payment 
     */
    public function createCashPayment($payable, $paymentDate, $paymentAmount);

    /**
     * Make a transfer payment.
     *
     * @param Request $request request containing data for transfer payment.
     * @return Payment created transfer payment.
     */
    public function createTransferPayment(Request $request);

    /**
     * Make a giro payment.
     *
     * @param Request $request request containing data for giro payment.
     * @param Giro $giro giro used for payment.
     * @return Payment created giro payment.
     */
    public function createGiroPayment(Request $request, Giro $giro);

    public function searchPayment($keyword);
}