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
 * App\Model\Accounting\Cost
 *
 * @property int $id
 * @property int $store_id
 * @property string $date
 * @property int $source_acc_cash_id
 * @property int $acc_cost_category_id
 * @property float $amount
 * @property string $remarks
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Accounting\CashAccount $sourceCashAccount
 * @property-read \App\Model\Accounting\CostCategory $category
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereSourceAccCashId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereAccCostCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereDeletedAt($value)
 * @mixin \Eloquent
 * @property int $source_cash_account_id
 * @property int $cost_category_id
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereSourceCashAccountId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost whereCostCategoryId($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\Cost withoutTrashed()
 */
class Cost extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'acc_cost';

    protected $fillable = [
        'store_id',
        'date',
        'source_cash_account_id',
        'cost_category_id',
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

    public function sourceCashAccount()
    {
        return $this->belongsTo('App\Model\Accounting\CashAccount', 'source_cash_account_id');
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