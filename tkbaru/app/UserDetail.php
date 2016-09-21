<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/7/2016
 * Time: 9:10 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserDetail
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property boolean $allow_login
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereAllowLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereUpdatedAt($value)
 */
class UserDetail extends Model
{
    protected $table = 'user_detail';

    protected $fillable = [
        'type', 'allow_login'
    ];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}