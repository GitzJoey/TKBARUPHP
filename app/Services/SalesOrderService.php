<?php
/**
 * Created by PhpStorm.
 * User: miftah.fathudin
 * Date: 11/14/2016
 * Time: 12:25 PM
 */

namespace App\Services;

use App\Model\SalesOrder;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

/**
 * A service class which provide some service for sales order operation such as creation, revision and rejection.
 *
 * Interface SalesOrderService
 * @package App\Services
 */
interface SalesOrderService
{
    /**
     * Save(create) a newly sales order. The saved(created) sales order will be returned.
     * Multiple sales orders can be created at once and all of them will be saved to user session as a collection by default.
     * This method will only save the sales order at sales order collection in user session with given index and will remove it from that array.
     *
     * @param Array $soData object which contains values from create form to create the sales order.
     * @return void
     */
    public function createSO(Array $soData);

    /**
     * Cancel a single sales order.
     * Multiple sales orders can be created at once and all of them will be saved to user session as a collection by default.
     * This method will remove the sales order in sales order collection in user session with given index.
     *
     * @param int $index index of the sales order in sales orders collection in user session to be cancelled.
     *
     * @return void
     */
    public function cancelSO($index);

    /**
     * Get sales order to be revised.
     *
     * @param int $id id of sales order to be revised.
     * @return SalesOrder sales order to be revised.
     */
    public function getSOForRevise($id);

    /**
     * Revise(modify) a sales order. If the sales order is still waiting for arrival, it's warehouse,
     * vendor trucking, shipping date and items can be changed. But, if it is already waiting for payment,
     * only it's items price can be changed. The revised(modified) sales order will be returned.
     *
     * @param Request $request request which contains values from revise form to revise the sales order.
     * @param int $id the id of sales order to be revised.
     * @return SalesOrder
     */
    public function reviseSO(Request $request, $id);

    /**
     * Reject a sales order. Only sales orders with status waiting for arrival can be rejected.
     *
     * @param Request $request request which contains values for sales order rejection.
     * @param int $id the id of sales order to be rejected.
     * @return void
     */
    public function rejectSO(Request $request, $id);

    /**
     * Store sales orders sent from the request to user session as a collection.
     * @param Request $request request which contains values for sales orders
     * @return Collection
     */
    public function storeToSession(Request $request);

    /**
     * Get a sales order with given code to be copied.
     *
     * @param string $soCode code of sales order to be copied.
     * @return SalesOrder sales order to be copied.
     */
    public function getSOForCopy($soCode);

    /**
     * Get a collection of sales orders that almost due for payment.
     *
     * @param int $daysToDue number of days before the sales order payment should be received.
     * @return Collection sales order that due for payment.
     */
    public function getDueSO($daysToDue = 1);

    /**
     * Get all sales order created on given date
     *
     * @param Carbon $date target date
     * @return Collection
     */
    public function getSOInOneDay($date);

    /**
     * Get total amount of all sales created on given date
     * 
     * @param Carbon $date target date
     * @return float
     */
    public function getSOTotalAmountInOneDay($date);

    /**
     * Get all sales orders that have not been delivered in more than 
     * given threshold days since its shipping date.
     *
     * @param int $threshold threshold in day
     * @return Collection
     */
    public function getUndeliveredSO($threshold = 3);

    /**
     * Get all created sales order from given date until current date.
     * 
     * @param Carbon
     * @return Collection
     */
    public function getCreatedSOFromDate($date);

    /**
     * Get all sales order that already delivered but still waiting for customer confirmation.
     *
     * @return Collection
     */
    public function getUncorfirmedSO();

    public function searchSO($keyword);

    public function searchSOByDate($date);

    public function updateSOStatus(SalesOrder $soData, $amount);

    public function getTop10Customer();

    public function getTop10WalkInCustomer();

    public function getSOByCode($code);

    public function addExpense($id, $expenseArr);
}
