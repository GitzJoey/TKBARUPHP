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
}
