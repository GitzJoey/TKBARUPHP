<?php

namespace App\Services;

use Doctrine\Common\Collections\Collection;

interface CustomerService
{
    /**
     * Get all customers that have one or more empty manual-filled fields/properties (except remarks).
     *
     * @return Collection unfinished customers
     */
    public function getUnfinisheCustomer();
}
