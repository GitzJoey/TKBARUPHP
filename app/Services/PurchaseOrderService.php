<?php

namespace App\Services;

use App\Model\PurchaseOrder;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: miftah.fathudin
 * Date: 11/13/2016
 * Time: 2:18 AM
 */

/**
 * A service class which provide some service for purchase order operation such as creation, revision and rejection.
 *
 * Interface PurchaseOrderService
 * @package App\Services
 */
interface PurchaseOrderService
{
    /**
     * Save(create) a newly purchase order. The saved(created) purchase order will be returned.
     *
     * @param Request $request request which contains values from create form to create the purchase order.
     * @return PurchaseOrder
     */
    public function createPO(Request $request);

    /**
     * Revise(modify) a purchase order. If the purchase order is still waiting for arrival, it's warehouse,
     * vendor trucking, shipping date and items can be changed. But, if it is already waiting for payment,
     * only it's items price can be changed. The revised(modified) purchase order will be returned.
     *
     * @param Request $request request which contains values from revise form to revise the purchase order.
     * @param $id the id of purchase order to be revised.
     * @return PurchaseOrder
     */
    public function revisePO(Request $request, $id);

    /**
     * Reject a purchase order. Only purchase orders with status waiting for arrival can be rejected.
     *
     * @param Request $request request which contains values for purchase order rejection.
     * @param $id the id of purchase order to be rejected.
     * @return void
     */
    public function rejectPO(Request $request, $id);
}