<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/17/2016
 * Time: 11:42 AM
 */

namespace App\Traits;

use App\Scopes\StoreFilterScope;

trait StoreFilter
{
    /**
     * Boot the store default filtering trait for model
     *
     * @return void
     */
    public static function bootStoreFilter()
    {
        static::addGlobalScope(new StoreFilterScope);
    }
}