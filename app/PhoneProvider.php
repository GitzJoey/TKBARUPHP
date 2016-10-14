<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 11:06 AM
 */

namespace App;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\PhoneProvider
 *
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereShortName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $prefix
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider wherePrefix($value)
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereDeletedAt($value)
 */
class PhoneProvider extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = "phone_provider";

    protected $fillable = [
        'name', 'short_name', 'prefix', 'status', 'remarks'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function getPhoneNumber()
    {
        $this->hasMany('App\PhoneNumber');
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