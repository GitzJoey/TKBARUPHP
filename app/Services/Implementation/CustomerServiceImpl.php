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
     * @param int | string $customerId
     * @return SalesOrder
     */
    public function getCustomerLastOrder($customerId)
    {
        $customer = Customer::with(['sales_orders' => function($query){
            $query->latest()->first();
        }], 'sales_orders.items')->findOrFail($customerId);

        return $customer->sales_orders->first();
    }

    /**
     * Get the total amount of customer's unpaid sales orders.
     *
     * @param mixed $customerId
     * @return float
     */
    public function getCustomerUnpaidSalesOrderTotalAmount($customerId){
        $customer = Customer::with('sales_orders')->findOrFail($customerId);

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
        $customers = Customer::all();
        $today = Carbon::today();

        function getCustomerLastOrder($customerId)
        {
            $customer = Customer::with(['sales_orders' => function($query){
                $query->latest()->first();
            }], 'sales_orders.items')->findOrFail($customerId);

            return $customer->sales_orders->first();
        }

        $passiveCustomers = $customers->filter(function($customer) use ($period, $today, $numberOfPeriod) {

            $customerLastSalesOrder = getCustomerLastOrder($customer->id);

            if(is_null($customerLastSalesOrder)) {
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

        $passiveCustomers->load('sales_orders');

        return response()->json($passiveCustomers);
    }

    public function searchCustomer($keyword)
    {

    }
}
