<?php

namespace App\Services;

use Doctrine\Common\Collections\Collection;

interface WarehouseService
{
    /**
     * Get all warehouses that have one or more empty manual-filled fields/properties (except remarks).
     *
     * @return Collection unfinished warehouses
     */
    public function getUnfinishedWarehouse();
}
