<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 12/1/2016
 * Time: 11:42 PM
 */

namespace App\Services;

use Illuminate\Http\Request;

interface PaymentService
{
    /**
     * Make a cash payment for payable model with given id.
     *
     * @param Request $request request containing data for cash payment.
     * @param int $payableId id of payable model.
     * @return mixed payable model paid.
     */
    public function createCashPayment(Request $request, $payableId);

    /**
     * Make a transfer payment for payable model with given id.
     *
     * @param Request $request request containing data for transfer payment.
     * @param int $payableId id of payable model.
     * @return mixed payable model paid.
     */
    public function createTransferPayment(Request $request, $payableId);

    /**
     * Make a giro payment for payable model with given id.
     *
     * @param Request $request request containing data for giro payment.
     * @param int $payableId id of payable model.
     * @return mixed payable model paid.
     */
    public function createGiroPayment(Request $request, $payableId);
}