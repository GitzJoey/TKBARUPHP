<?php

namespace App\Services\Implementation;

use App\Model\Customer;
use App\Services\CustomerService;

use Carbon\Carbon;
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
        return Customer::orWhereNull('sign_code')
        ->orWhereNull('name')
        ->orWhereNull('address')
        ->orWhereNull('city')
        ->orWhereNull('phone_number')
        ->orWhereNull('fax_num')
        ->orWhereNull('tax_id')
        ->orWhereNull('payment_due_day')
        ->get();
    }

    /**
     * Check whether there are some customers that have one 
     * or more empty manual-filled fields/properties (except remarks) or not.
     *
     * @return bool
     */
    public function isUnfinishedCustomerExist()
    {
        return count(getUnfinishedCustomer()) > 0;
    }

    /**
     * Get customer last sales order.
     *
     * @param mixed $customer
     * @return SalesOrder
     */
    public function getCustomerLastOrder($customer)
    {
        $customer = Customer::with(['sales_orders' => function($query){
            $query->latest()->first();
        }], 'sales_orders.items')->findOrFail($customer);

        return $customer->sales_orders->first();
    }

    /**
     * Get the total amount of customer's unpaid sales orders.
     *
     * @param mixed $customer
     * @return float
     */
    public function getCustomerUnpaidSalesOrderTotalAmount($customer){
        $customer = Customer::with('sales_orders')->findOrFail($customer);

        $customerUnpaidSalesOrderAmounts = $customer->sales_orders->map(function($sales_order){
            return $sales_order->totalAmountUnpaid();
        });

        return count($customerUnpaidSalesOrderAmounts) > 0 ? $customerUnpaidSalesOrderAmounts->sum() : 0;
    }

    /**
     * Get all passive customers in a period of time.
     * Passive customers are customers who don't make any sales order.
     *
     * @param int $numberOfPeriod number of period
     * @param string $period period of time. Can be days, weeks, months, or years.
     * @return Collection
     */
    public function getPassiveCustomer($numberOfPeriod = 1, $period = "months")
    {
        //TODO : Find another effective algorithm !
        $customers = Customer::all();
        $today = Carbon::today();

        $passiveCustomers = $customers->filter(function($customer){
            $customerLastSalesOrder = getCustomerLastOrder($customer->id);
            if(is_null($customerLastSalesOrder)){
                // TODO : Change to switch case alike
                if($period === "days"){
                    return $today->diffInDays($customer->created_at) >= $numberOfPeriod;
                }
                elseif ($period === "weeks") {
                    return $today->diffInWeeks($customer->created_at) >= $numberOfPeriod;
                }
                elseif ($period === "months") {
                    return $today->diffInMonths($customer->created_at) >= $numberOfPeriod;
                }
                else{
                    return $today->diffInYears($customer->created_at) >= $numberOfPeriod;
                }
            } else {
                // TODO : Change to switch case alike
                if($period === "days"){
                    return $today->diffInDays($customerLastSalesOrder->so_created) >= $numberOfPeriod;
                }
                elseif ($period === "weeks") {
                    return $today->diffInWeeks($customerLastSalesOrder->so_created) >= $numberOfPeriod;
                }
                elseif ($period === "months") {
                    return $today->diffInMonths($customerLastSalesOrder->so_created) >= $numberOfPeriod;
                }
                else{
                    return $today->diffInYears($customerLastSalesOrder->so_created) >= $numberOfPeriod;
                }
            }
        });

        return $passiveCustomers;
    }
}
