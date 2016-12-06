<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 12/2/2016
 * Time: 9:13 PM
 */

namespace App\Services;

use Illuminate\Http\Request;

interface StoreService
{
    public function getAllStore();

    public function getStore($id);

    public function saveStore(Request $request);

    public function getAllStorePaginated($viewPerPage);

    public function isEmptyStoreTable();

    public function defaultStorePresent();

    public function getDefaultStore();

    public function setDefaultStore($id);

    public function createDefaultStore($storeName);
}