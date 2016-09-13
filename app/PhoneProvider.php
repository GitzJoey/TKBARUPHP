<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 11:06 AM
 */

namespace App;

use \Illuminate\Database\Eloquent\Model;

class PhoneProvider extends Model
{
    protected $table = "phone_provider";

    protected $fillable = [
        'name', 'short_name', 'prefix', 'status', 'remarks'
    ];

}