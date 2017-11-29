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
 * App\Model\EmployeeSalaryHist
 *
 * @property int $id
 * @property int $store_id
 * @property int $employee_id
 * @property string $type
 * @property string $description
 * @property int $amount
 * @property int $balance
 * @property bool $is_last
 * @property string $salary_period
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereEmployeeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereBalance($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereIsLast($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereSalaryPeriod($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EmployeeSalaryHist withoutTrashed()
 * @property-read mixed $h_id
 */
class EmployeeSalaryHist extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'employee_salary_hist';

    protected $fillable = [
        'employee_id',
        'type',
        'store_id',
        'description',
        'amount',
        'balance',
        'salary_period',
        'is_last',
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $appends = [
        'hId',
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function getHIdAttribute()
    {
        return $this->hId();
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