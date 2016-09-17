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