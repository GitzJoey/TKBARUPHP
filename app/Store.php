<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/7/2016
 * Time: 9:46 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'store';

    protected $fillable = [
        'name', 'address', 'phone_num', 'fax_num', 'tax_id', 'status', 'is_default', 'remarks'
    ];

}