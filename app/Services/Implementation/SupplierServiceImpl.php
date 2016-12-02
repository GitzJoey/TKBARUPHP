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

    /**
     * Get suppliers with all related data for creating purchase order.
     *
     * @return Collection collection of Suppliers
     */
    public function getSuppliersForCreatePO()
    {
        return Supplier::with('profiles.phoneNumbers.provider', 'bankAccounts.bank',
            'products.productUnits.unit', 'products.type', 'expenseTemplates')->get();
    }
}