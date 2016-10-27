<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Payment
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $type
 * @property string $payment_date
 * @property string $effective_date
 * @property float $total_amount
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payments whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payments whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payments whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payments wherePaymentDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payments whereEffectiveDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payments whereTotalAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payments whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payments whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payments whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payments whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payments whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payments whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'payments';

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
