<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 12/1/2016
 * Time: 8:59 PM
 */

namespace App\Services;

use Doctrine\Common\Collections\Collection;

interface SupplierService
{
    /**
     * Get suppliers with all related data for creating purchase order.
     *
     * @return Collection collection of Suppliers
     */
    public function getSuppliersForCreatePO();

    /**
     * Get all suppliers that have one or more empty manual-filled fields/properties (except remarks).
     *
     * @return Collection unfinished suppliers
     */
    public function getUnfinishedSupplier();

    /**
     * Check whether there are some suppliers that have one 
     * or more empty manual-filled fields/properties (except remarks) or not.
     * 
     * @return bool
     */
    public function isUnfinishedSupplierExist();

    public function searchSupplier($keyword);
}
