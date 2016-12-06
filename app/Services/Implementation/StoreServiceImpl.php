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
        $store = $this->getDefaultStore();

        if ($store) return true;
        else return false;
    }

    public function getDefaultStore()
    {
        return Store::whereIsDefault('YESNOSELECT.YES')->get()->first();
    }

    public function createDefaultStore($storeName)
    {
        $store = new Store();
        $store->name = $storeName;

        $store->save();

        return $store->id;
    }
}