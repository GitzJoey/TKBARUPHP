<?php
/**
 * Created by PhpStorm.
 * User: miftah.fathudin
 * Date: 11/13/2016
 * Time: 2:18 AM
 */

namespace App\Services;

use App\Model\PurchaseOrder;
use Doctrine\Common\Collections\Collection;
use Illuminate\Http\Request;

/**
 * A service class which provide some service for purchase order.
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
     * @return PurchaseOrder created purchase order.
     */
    public function createPO(Request $request);

    /**
     * Get purchase order to be revised.
     *
     * @param int $poId id of purchase order to be revised.
     * @return PurchaseOrder purchase order to be revised.
     */
    public function getPOForRevise($poId);

    /**
     * Revise(modify) a purchase order. If the purchase order is still waiting for arrival, it's warehouse,
     * vendor trucking, shipping date and items can be changed. But, if it is already waiting for payment,
     * only it's items price can be changed. The revised(modified) purchase order will be returned.
     *
     * @param Request $request request which contains values from revise form to revise the purchase order.
     * @param int $poId the id of purchase order to be revised.
     * @return PurchaseOrder revised purchase order.
     */
    public function revisePO(Request $request, $poId);

    /**
     * Reject a purchase order. Only purchase orders with status waiting for arrival can be rejected.
     *
     * @param Request $request request which contains values for purchase order rejection.
     * @param int $poId the id of purchase order to be rejected.
     * @return void
     */
    public function rejectPO(Request $request, $poId);

    /**
     * Get purchase order which items want to be received.
     *
     * @param int $poId id of purchase order which items want to be received.
     * @return PurchaseOrder purchase order which items want to be received.
     */
    public function getPOForReceipt($poId);

    /**
     * Get all purchase order which belongs to warehouse with given id.
     *
     * @param int $warehouseId id of warehouse owning the purchase order(s).
     * @return Collection purchase orders of given warehouse.
     */
    public function getWarehousePO($warehouseId);

    /**
     * Get a purchase order with it's details related to payment.
     *
     * @param int $poId id of purchase order.
     * @return PurchaseOrder
     */
    public function getPOForPayment($poId);

    /**
     * Get purchase order to be copied.
     *
     * @param string $poCode code of purchase order.
     * @return PurchaseOrder
     */
    public function getPOForCopy($poCode);

    /**
     * Get a collection of purchase orders that almost due for payment.
     *
     * @param int $daysToDue number of days before the purchase order must be paid.
     * @return Collection purchase order that due for payment.
     */
    public function getDuePO($daysToDue = 1);

     /**
     * Get all purchase orders that have not been received in more than 
     * given threshold days since its shipping date.
     *
     * @param int $threshold threshold in day
     * @return Collection
     */
    public function getUnreceivedPO($threshold = 3);

    public function searchPO($keyword);

    public function searchPOByDate($date);

    public function updatePOStatus(PurchaseOrder $poData, $amount);

    public function getLastPODates($limit);

    public function getPOByCode($code);

    public function addExpenses($poId, $expenseArr);
}
