<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 1/29/2017
 * Time: 3:16 AM
 */

namespace App\Services\Implementation;

use App\Model\Warehouse;
use App\Services\WarehouseService;

use Doctrine\Common\Collections\Collection;

class WarehouseServiceImpl implements WarehouseService
{
    /**
     * Get all warehouses that have one or more empty manual-filled fields/properties (except remarks).
     *
     * @return Collection unfinished warehouses
     */
    public function getUnfinishedWarehouse()
    {
        return Warehouse::orWhereNull('name')
            ->orWhereNull('address')
            ->orWhereNull('phone_num')
            ->get();
    }

    /**
     * Check whether there are some warehouses that have one
     * or more empty manual-filled fields/properties (except remarks) or not.
     *
     * @return bool
     */
    public function isUnfinishedWarehouseExist()
    {
        return count($this->getUnfinishedWarehouse()) > 0;
    }
}