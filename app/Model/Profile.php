<?php

/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:06 AM
 */

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Profile
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $owner_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $ic_num
 * @property string $image_filename
 * @property string $owner_type
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PhoneNumber[] $phoneNumbers
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $owner
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereIcNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereImageFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereOwnerType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Profile withoutTrashed()
 */
class Profile extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'profiles';

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'ic_num',
        'image_filename',
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
        'owner_type'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function phoneNumbers()
    {
        return $this->hasMany('App\Model\PhoneNumber');
    }

    public function owner(){
        // Customer | Supplier
        return $this->morphTo();
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
