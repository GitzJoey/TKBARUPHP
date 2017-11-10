<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 11:06 AM
 */

namespace App\Model;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\PhoneProvider
 *
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property string $status
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PhonePrefix[] $prefixes
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider whereShortName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PhoneProvider withoutTrashed()
 */
class PhoneProvider extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = "phone_providers";

    protected $fillable = [
        'name',
        'short_name',
        'status',
        'remarks'
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function phoneNumbers()
    {
        $this->hasMany('App\Model\PhoneNumber');
    }

    public function prefixes()
    {
        return $this->hasMany('App\Model\PhonePrefix');
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