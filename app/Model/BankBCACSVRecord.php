<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * App\Model\BankBCACSVRecord
 *
 * @property integer $id
 * @property \Carbon\Carbon $date
 * @property string $remarks
 * @property string $branch
 * @property float $amount
 * @property string $db_cr
 * @property float $balance
 * @property integer $bank_upload_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereBranch($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereDbCr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereBalance($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereBankUploadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankBCACSVRecord withoutTrashed()
 */
class BankBCACSVRecord extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'date'];

    protected $table = 'bank_bca_csv_records';

    protected $fillable = [
        'date', 'remarks', 'branch', 'amount', 'db_cr', 'balance', 'bank_upload_id'
    ];

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
