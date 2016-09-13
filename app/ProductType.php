<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 1:40 PM
 */

namespace App;

use \Illuminate\Database\Eloquent\Model;

/**
 * App\ProductType
 *
 * @mixin \Eloquent
 */
class ProductType extends Model
{
    protected $table = 'product_type';

    protected $fillable = [
        'name', 'short_code', 'description', 'status'
    ];
}