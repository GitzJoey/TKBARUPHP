<?php

namespace App\Services\Implementation;

use App\Model\Product;
use App\Services\ProductService;

use Doctrine\Common\Collections\Collection;

class ProductServiceImpl implements ProductService
{
    /**
     * Get all products that have one or more empty manual-filled fields/properties (except remarks).
     *
     * @return Collection unfinished products
     */
    public function getUnfinisheProduct()
    {
        return Product::orWhereNull('name')
            ->orWhereNull('short_code')
            ->orWhereNull('description')
            ->orWhereNull('image_path')
            ->get();
    }

    public function searchProduct($keyword)
    {

    }
}
