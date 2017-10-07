<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:25 AM
 */

namespace App\Model;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Bank
 *
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property string $branch
 * @property string $branch_code
 * @property string $status
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read mixed $bank_full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BankAccount[] $bankAccounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Giro[] $Giros
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank whereShortName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank whereBranch($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank whereBranchCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Bank withoutTrashed()
 */
class Bank extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'banks';

    protected $fillable = [
        'name',
        'short_name',
        'branch',
        'branch_code',
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

    public function getBankFullNameAttribute()
    {
        return $this->attributes['name'] . ' ' . '(' . $this->attributes['short_name'] . ')';
    }

    public function bankAccounts()
    {
        return $this->hasMany('App\Model\BankAccount', 'bank_id');
    }

    public function Giros()
    {
        return $this->hasMany('App\Model\Giro', 'bank_id');
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