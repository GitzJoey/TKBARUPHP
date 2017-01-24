<?php

namespace App\Service\Implementation;

use App\Model\VendorTrucking;
use App\Services\VendorTruckingService;

use Doctrine\Common\Collections\Collection;

class VendorTruckingServiceImpl implements VendorTruckingService
{
    /**
     * Get all vendor truckings that have one or more empty manual-filled fields/properties (except remarks).
     *
     * @return Collection unfinished vendor truckings
     */
    public function getUnfinishedVendorTrucking()
    {
        return VendorTrucking::orWhereNull('name')
        ->orWhereNull('address')
        ->orWhereNull('tax_id')
        ->get();
    }

    /**
     * Check whether there are some vendor truckings that have one 
     * or more empty manual-filled fields/properties (except remarks) or not.
     *
     * @return bool
     */
    public function isUnfinishedVendorTruckingExist()
    {
        return count(getUnfinishedVendorTrucking()) > 0;
    }
}
