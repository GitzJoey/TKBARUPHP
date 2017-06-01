<?php

namespace App\Services;

use App\Model\SalesOrder;

use Doctrine\Common\Collections\Collection;

interface CustomerService
{
    /**
     * Get all customers that have one or more empty manual-filled fields/properties (except remarks).
     *
     * @return Collection unfinished customers
     */
    public function getUnfinishedCustomer();

    /**
     * Check whether there are some customers that have one 
     * or more empty manual-filled fields/properties (except remarks) or not.
     *
     * @return bool
     */
    public function isUnfinishedCustomerExist();

    /**
     * Get customer last sales order.
     *
     * @param int | string $customerId
     * @return SalesOrder
     */
    public function getCustomerLastOrder($customer);

    /**
     * Get the total amount of customer's unpaid sales orders.
     *
     * @param int|string $customerId
     * @return float
     */
    public function getCustomerUnpaidSalesOrderTotalAmount($customerId);

    /**
     * Get all passive customers in a period of time.
     * Passive customers are customers who don't make any sales order.
     *
     * @param int $numberOfPeriod number of period
     * @param string $period period of time. Can be days, weeks, months, or years.
     * @return Collection
     */
    public function getPassiveCustomer($numberOfPeriod = 1, $period = "months");

    public function searchCustomer($keyword);
}
