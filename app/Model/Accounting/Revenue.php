<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 2/8/2017
 * Time: 12:04 AM
 */

namespace App\Model\Accounting;

use App\Traits\StoreFilter;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Accounting\Revenue
 *
 * @property int $id
 * @property int $store_id
 * @property string $date
 * @property int $destination_acc_cash_id
 * @property int $acc_revenue_category_id
 * @property float $amount
 * @property string $remarks
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereDestinationAccCashId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereAccRevenueCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereDeletedAt($value)
 * @mixin \Eloquent
 * @property int $destination_cash_account_id
 * @property int $revenue_category_id
 * @property-read \App\Model\Accounting\CashAccount $destinationCashAccount
 * @property-read \App\Model\Accounting\CostCategory $category
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereDestinationCashAccountId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue whereRevenueCategoryId($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Revenue withoutTrashed()
 */
class Revenue extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'acc_revenue';

    protected $fillable = [
        'store_id',
        'date',
        'destination_cash_account_id',
        'revenue_category_id',
        'amount',
        'remarks',
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

    public function destinationCashAccount()
    {
        return $this->belongsTo('App\Model\Accounting\CashAccount', 'destination_cash_account_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Accounting\CostCategory', 'cost_category_id');
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