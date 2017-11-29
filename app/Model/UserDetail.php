<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/7/2016
 * Time: 9:10 AM
 */

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\UserDetail
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property boolean $allow_login
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserDetail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserDetail whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserDetail whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserDetail whereAllowLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserDetail whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserDetail whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserDetail whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserDetail whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserDetail onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserDetail withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserDetail withoutTrashed()
 */
class UserDetail extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'user_details';

    protected $fillable = [
        'is_activated',
        'type',
        'allow_login'
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            if ($user) {
                $model->created_by = $user->id;
                $model->updated_by = $user->id;
            }
        });

        static::updating(function ($model) {
            $user = Auth::user();
            if ($user) {
                $model->updated_by = $user->id;
            }
        });

        static::deleting(function ($model) {
            $user = Auth::user();
            if ($user) {
                $model->deleted_by = $user->id;
                $model->save();
            }
        });
    }
}