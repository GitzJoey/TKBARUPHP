<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * App\Model\Payment
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $payment_detail_id
 * @property integer $payable_id
 * @property string $type
 * @property string $payable_type
 * @property string $payment_detail_type
 * @property \Carbon\Carbon $payment_date
 * @property float $total_amount
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payment_detail
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment wherePaymentDetailId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment wherePayableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment wherePayableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment wherePaymentDetailType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment wherePaymentDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereTotalAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment withoutTrashed()
 */
class Payment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'payment_date'];

    protected $hidden = [
        'payment_detail_type', 'payable_type'
    ];

    protected $fillable = ['payment_date', 'total_amount', 'status', 'type'];

    public function payment_detail()
    {
        // CashPayment | TransferPayment | GiroPayment
        return $this->morphTo();
    }

    public function payable()
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
