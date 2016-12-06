<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 12/2/2016
 * Time: 10:04 PM
 */

namespace App\Services\Implementation;

use App\Model\Store;

use App\Services\StoreService;

class StoreServiceImpl implements StoreService
{
    public function isEmptyStoreTable()
    {
        $store = Store::count();

        if ($store == 0) return true;
        else return false;
    }

    public function defaultStorePresent()
    {
        $store = Store::whereIsDefault('YESNOSELECTION.YES')->get()-first();

        if ($store) return true;
        else return false;
    }

    public function createDefaultStore($store_name)
    {
        $store = new Store();
        $store->name = $store_name;

        $store->save();

        return $store->id;
    }
}