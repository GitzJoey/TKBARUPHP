<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 12:44 AM
 */

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use \Illuminate\Database\Eloquent\Model;

/**
 * App\PriceLevel
 *
 * @mixin \Eloquent
 */
class PriceLevel extends Model
{
    protected $table = 'price_level';

    protected $fillable = [
        'store_id', 'type', 'weight', 'name', 'description', 'increment_value', 'percentage_value', 'status',
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }
}