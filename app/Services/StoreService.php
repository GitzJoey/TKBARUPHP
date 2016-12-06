<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 12/2/2016
 * Time: 9:13 PM
 */

namespace App\Services;

interface StoreService
{
    public function isEmptyStoreTable();

    public function defaultStorePresent();

    public function getDefaultStore();

    public function createDefaultStore($storeName);
}