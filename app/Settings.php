<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/6/2016
 * Time: 1:13 AM
 */

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Settings
 *
 * @property string $skey
 * @property string $category
 * @property string $value
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereSkey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Settings whereUserId($value)
 */
class Settings extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'category',
        'skey',
        'value',
        'description'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function user()
    {
        $this->belongsTo('\App\User');
    }
}