<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/6/2016
 * Time: 1:13 AM
 */

namespace App\Model;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Setting
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $skey
 * @property string $value
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Setting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Setting whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Setting whereSkey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    protected $table = 'settings';

    public $timestamps = false;

    protected $fillable = [
        'skey',
        'value'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function user()
    {
        $this->belongsTo('App\User');
    }
}