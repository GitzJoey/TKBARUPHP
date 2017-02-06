<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 2/6/2017
 * Time: 6:18 PM
 */

namespace App\Services\Implementation;

use DB;
use Exception;
use App\Services\DatabaseService;

class DatabaseServiceImpl implements DatabaseService
{
    public function isOnline()
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}