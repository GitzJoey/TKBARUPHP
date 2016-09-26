<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/21/2016
 * Time: 4:36 PM
 */

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Warehouse
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone_num
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse wherePhoneNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Warehouse extends Model
{
    protected $table = 'warehouse';

    protected $fillable = [
        'store_id', 'name', 'address', 'phone_num', 'status', 'remarks'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }
}