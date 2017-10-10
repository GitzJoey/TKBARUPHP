<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * App\Model\BankUpload
 *
 * @property integer $id
 * @property string $filename
 * @property string $bank
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankUpload whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankUpload whereFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankUpload whereBank($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankUpload whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankUpload whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankUpload whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankUpload whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankUpload whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankUpload whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankUpload onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankUpload withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankUpload withoutTrashed()
 */
class BankUpload extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'bank_uploads';

    protected $fillable = [
        'bank', 'filename'
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
