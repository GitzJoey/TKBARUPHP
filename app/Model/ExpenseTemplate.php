<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\ExpenseTemplate
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property float $amount
 * @property boolean $is_internal_expense
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereIsInternalExpense($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ExpenseTemplate withoutTrashed()
 */
class ExpenseTemplate extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'expense_templates';

    protected $fillable = [
        'name', 'type', 'amount', 'remarks', 'is_internal_expense'
    ];

    public function hId()
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
