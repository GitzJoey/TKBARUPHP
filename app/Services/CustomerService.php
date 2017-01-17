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
     * Get customer last sales order.
     *
     * @param mixed $customer
     * @return SalesOrder
     */
    public function getCustomerLastOrder($customer);

    /**
     * Get the total amount of customer's unpaid sales orders.
     *
     * @param mixed $customer
     * @return float
     */
    public function getCustomerUnpaidSalesOrderTotalAmount($customer);

    /**
     * Get all passive customers in some period of time.
     * Passive customers are customers who don't make any sales order.
     *
     * @param int $numberOfPeriod number of period
     * @param string $period period of time. Can be days, months, or years.
     * @return Collection
     */
    public function getPassiveCustomer($numberOfPeriod = 1, $period = "months");
}
