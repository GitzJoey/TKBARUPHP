<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 12/1/2016
 * Time: 9:01 PM
 */

namespace App\Services\Implementation;

use App\Model\Supplier;
use App\Services\SupplierService;
use Doctrine\Common\Collections\Collection;

class SupplierServiceImpl implements SupplierService
{
    public function getSuppliersForCreatePO()
    {
        return Supplier::with('profiles.phoneNumbers.provider', 'bankAccounts.bank',
            'products.productUnits.unit', 'products.type', 'expenseTemplates')->get();
    }

    public function getUnfinisheSupplier()
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
