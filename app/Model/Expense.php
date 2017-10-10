<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\Expense
 *
 * @property integer $id
 * @property integer $expensable_id
 * @property string $name
 * @property string $type
 * @property float $amount
 * @property boolean $is_internal_expense
 * @property string $remarks
 * @property string $expensable_type
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $expensable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereExpensableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereIsInternalExpense($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereExpensableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Expense withoutTrashed()
 */
class Expense extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'expenses';

    protected $fillable = [
        'name', 'type', 'amount', 'remarks', 'is_internal_expense'
    ];

    protected $hidden = [
        'expensable_type'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function expensable()
    {
        // SalesOrder | PurchaseOrder
        return $this->morphTo();
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
