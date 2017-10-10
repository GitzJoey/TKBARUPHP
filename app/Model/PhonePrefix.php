<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/20/2016
 * Time: 9:07 AM
 */

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\PhonePrefix
 *
 * @property integer $id
 * @property integer $phone_provider_id
 * @property string $prefix
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhonePrefix whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhonePrefix wherePhoneProviderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhonePrefix wherePrefix($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhonePrefix whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhonePrefix whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhonePrefix whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhonePrefix whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhonePrefix whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhonePrefix whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhonePrefix onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhonePrefix withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhonePrefix withoutTrashed()
 */
class PhonePrefix extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'phone_prefixes';

    protected $fillable = ['phone_provider_id', 'prefix'];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function providers()
    {
        $this->belongsTo('App\Model\PhoneProvider', 'phone_provider_id');
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