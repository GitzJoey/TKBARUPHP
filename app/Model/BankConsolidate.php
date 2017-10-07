<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * App\Model\BankConsolidate
 *
 * @property integer $id
 * @property string $date
 * @property string $remarks
 * @property float $amount
 * @property string $db_cr
 * @property float $balance
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate whereDbCr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate whereBalance($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankConsolidate withoutTrashed()
 */
class BankConsolidate extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'bank_consolidates';

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
