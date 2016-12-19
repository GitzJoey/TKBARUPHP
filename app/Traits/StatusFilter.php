<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 12/20/2016
 * Time: 1:10 AM
 */

namespace App\Traits;

use App\Scopes\StatusFilterScope;

trait StatusFilter
{
    /**
     * Boot the store default filtering trait for model
     *
     * @return void
     */
    public static function bootStatusFilter()
    {
        static::addGlobalScope(new StatusFilterScope);
    }
}