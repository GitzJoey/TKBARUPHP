<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 11:05 AM
 */

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\PhoneNumber
 *
 * @property integer $id
 * @property integer $profile_id
 * @property integer $phone_provider_id
 * @property string $number
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\PhoneProvider $provider
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber wherePhoneProviderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber whereNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneNumber withoutTrashed()
 */
class PhoneNumber extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'phone_numbers';

    protected $fillable = ['phone_provider_id', 'number', 'status', 'remarks'];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function profile()
    {
        $this->belongsTo('App\Model\Profile');
    }

    public function provider()
    {
        return $this->belongsTo('App\Model\PhoneProvider', 'phone_provider_id');
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