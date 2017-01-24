<?php

namespace App\Services;

use Doctrine\Common\Collections\Collection;

interface VendorTruckingService
{
    /**
     * Get all vendor truckings that have one or more empty manual-filled fields/properties (except remarks).
     *
     * @return Collection unfinished vendor truckings
     */
    public function getUnfinishedVendorTrucking();

    /**
     * Check whether there are some vendor truckings that have one 
     * or more empty manual-filled fields/properties (except remarks) or not.
     * 
     * @return bool
     */
    public function isUnfinishedVendorTruckingExist();
}
