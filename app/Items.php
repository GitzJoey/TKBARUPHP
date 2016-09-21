<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 12:07 AM
 */

namespace App;

use \Illuminate\Database\Eloquent\Model;

/**
 * App\Items
 *
 * @mixin \Eloquent
 */
class Items extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'quantity',
    ];

    //Many to One
    /*
    public function product()
    {
        return $this->belongsTo('product', 'product_id');
    }

    public function unit_code()
    {

    }
    */
}