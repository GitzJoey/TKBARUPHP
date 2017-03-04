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
 * App\Model\Employee
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
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereIcNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereImagePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereDeletedAt($value)
 * @mixin \Eloquent
 * @property integer $deleted_by
 * @property-read \App\Model\Store $store
 * @property int $store_id
 * @property string $address
 * @property string $start_date
 * @property bool $freelance
 * @property int $base_salary
 * @property string $status
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereFreelance($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereBaseSalary($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Employee whereStatus($value)
 */
class Employee extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'employees';

    protected $fillable = [
        'store_id',
        'name',
        'address',
        'ic_number',
        'start_date',
        'freelance',
        'base_salary',
        'image_path',
        'status,'
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

    public function store()
    {
        return $this->belongsTo('App\Model\Store');
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
    public function transaction($amount,$salaryTitle,$description,$is_salary=0){
        $lastHist=EmployeeSalaryHist::where('employee_id',$this->id)
                        ->where('is_last',1)
                        ->first();
        if($lastHist==null){
            $lastBalance=0;
        }else{
            $lastBalance=$lastHist->balance;
            $lastHist->is_last=0;
            $lastHist->save();
        }
        $hist=EmployeeSalaryHist::create([
            'employee_id'=>$this->id,
            'title'=>$salaryTitle,
            'description'=>$description,
            'amount'=>$amount,
            'balance'=>$lastBalance+$amount,
            'is_last'=>1,
            'is_salary'=>$is_salary,
        ]);
        return $hist;
    }
    public function lastPayment(){
        $hist=EmployeeSalaryHist::where('amount','<',0)
            ->where('employee_id',$this->id)
            ->orderBy('id','desc')
            ->first();
        return $hist;
    }
}