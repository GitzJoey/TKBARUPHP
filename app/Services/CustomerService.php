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
}
