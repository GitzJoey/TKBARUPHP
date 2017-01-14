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

    public function isEmptyStoreTable();

    public function defaultStorePresent();

    public function getDefaultStore();

    public function getFrontWebStore();

    public function resetIsDefault();

    public function resetFrontWeb();

    public function setDefaultStore($id);

    public function createDefaultStore($storeName);

    public function applySettings();

    /**
     * Get all stores that have one or more empty fields/properties (except remarks).
     *
     * @return Collection unfinished stores
     */
    public function getUnfinishedStore();
}
