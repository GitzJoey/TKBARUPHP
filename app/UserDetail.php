<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/7/2016
 * Time: 9:10 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetail whereDeletedAt($value)
 */
class UserDetail extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'user_detail';

    protected $fillable = [
        'type', 'allow_login'
    ];

    public function getUser() {
        return $this->belongsTo('App\User');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $user = Auth::user();
            if ($user) {
                $model->created_by = $user->id;
                $model->updated_by = $user->id;
            }
        });

        static::updating(function($model)
        {
            $user = Auth::user();
            if ($user) {
                $model->updated_by = $user->id;
            }
        });

        static::deleting(function($model)
        {
            $user = Auth::user();
            if ($user) {
                $model->deleted_by = $user->id;
                $model->save();
            }
        });
    }
}