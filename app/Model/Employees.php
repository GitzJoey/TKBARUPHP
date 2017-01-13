<?php
/**
 * Created by PhpStorm.
 * User: heroes-4
 * Date: 1/4/2017
 * Time: 1:53 PM
 */

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;


/**
 * App\Model\Employees
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $ic_number
 * @property string $image_path
 * @property string $remember_token
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_bygitu keliatan berarti
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employees whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employees whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employees whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employees whereIcNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employees whereImagePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employees whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employees whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employees whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employees whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employees whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employees whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employees whereDeletedAt($value)
 * @mixin \Eloquent
 * @property integer $deleted_by
 */
class Employees extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'email',
        'ic_number',
        'image_path'
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function hId() //hahah
    {
        return HashIds::encode($this->attributes['id']);
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