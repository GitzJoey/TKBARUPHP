<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:17 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $table = 'truck';

    protected $fillable = [
        'plate_number', 'inspection_date', 'driver', 'status', 'remarks'
    ];
}