<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:25 AM
 */

namespace App;

use \Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';

    protected $fillable = [
        'bank_name', 'branch', 'status', 'remarks'
    ];

}