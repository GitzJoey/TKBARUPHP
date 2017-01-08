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
     * Make a cash payment.
     *
     * @param Request $request request containing data for cash payment.
     * @return Payment created cash payment.
     */
    public function createCashPayment(Request $request);

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
}