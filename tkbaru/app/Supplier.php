<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:17 AM
 */

namespace App;

use \Illuminate\Database\Eloquent\Model;

/**
 * App\Supplier
 *
 * @mixin \Eloquent
 */
class Supplier extends Model
{
    protected $table = 'supplier';

    protected $fillable = [
        'supplier_name', 'supplier_address', 'supplier_city', 'remarks',
    ];

}