<?php

namespace App\Services\Implementation;

use App\Model\Customer;
use App\Services\CustomerService;

use Doctrine\Common\Collections\Collection;

class CustomerServiceImpl implements CustomerService
{
    /**
     * Get all customers that have one or more empty manual-filled fields/properties (except remarks).
     *
     * @return Collection unfinished customers
     */
    public function getUnfinishedCustomer()
    {
        return Product::orWhereNull('sign_code')
        ->orWhereNull('name')
        ->orWhereNull('address')
        ->orWhereNull('city')
        ->orWhereNull('phone_number')
        ->orWhereNull('fax_num')
        ->orWhereNull('tax_id')
        ->orWhereNull('payment_due_day')
        ->get();
    }
}
