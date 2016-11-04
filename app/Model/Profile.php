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
 * App\Profile
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $user_id
 * @property string $ic_num
 * @property string $image_filename
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereIcNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereImageFilename($value)
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PhoneNumber[] $phone
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Supplier[] $supplier
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PhoneNumber[] $phoneNumbers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Supplier[] $suppliers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Customer[] $customers
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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function phoneNumbers()
    {
        return $this->hasMany('App\Model\PhoneNumber');
    }

    public function customers()
    {
        return $this->belongsToMany('App\Model\Customer', 'customer_pic', 'profile_id', 'customer_id');
    }

    public function suppliers()
    {
        return $this->belongsToMany('App\Model\Supplier', 'supplier_pic', 'profile_id', 'supplier_id');
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