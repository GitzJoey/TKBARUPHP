<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 12/2/2016
 * Time: 10:04 PM
 */

namespace App\Services\Implementation;

use Illuminate\Http\Request;

use App\Model\Store;

use App\Services\StoreService;

class StoreServiceImpl implements StoreService
{
    public function getAllStore()
    {
        $store = Store::get();

        return $store;
    }

    public function getStore($id)
    {
        $store = Store::with('bankAccounts.bank')->where('id', '=', $id)->first();

        return $store;
    }

    public function isEmptyStoreTable()
    {
        $store = Store::count();

        if ($store == 0) return true;
        else return false;
    }

    public function defaultStorePresent()
    {
        $store = $this->getDefaultStore();

        if (!is_null($store)) return true;
        else return false;
    }

    public function getDefaultStore()
    {
        return Store::whereIsDefault('YESNOSELECT.YES')->get()->first();
    }

    public function setDefaultStore($id)
    {
        $store = Store::find($id);

        $this->resetIsDefault();

        $store->is_default = 'YESNOSELECT.YES';
        $store->save();
    }

    public function resetIsDefault()
    {
        $store = Store::whereIsDefault('YESNOSELECT.YES')->get();

        foreach ($store as $s) {
            $s->is_default = Lookup::whereCode('YESNOSELECT.NO')->first()->code;
            $s->save();
        }
    }

    public function createDefaultStore($storeName)
    {
        $store = new Store();
        $store->name = $storeName;
        $store->status = 'STATUS.ACTIVE';
        $store->is_default = 'YESNOSELECT.YES';

        $store->save();

        return $store->id;
    }
}