<?php

namespace App\Services;

use Doctrine\Common\Collections\Collection;

interface ProductService
{
    /**
     * Get all products that have one or more empty manual-filled fields/properties (except remarks).
     *
     * @return Collection unfinished products
     */
    public function getUnfinisheProduct();

    public function searchProduct($keyword);
}
