<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 1/31/2017
 * Time: 8:57 AM
 */

namespace App\Model\Accounting;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\StoreFilter;

/**
 * App\Model\Accounting\RevenueCategory
 *
 * @property int $id
 * @property int $store_id
 * @property string $group
 * @property string $name
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\RevenueCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\RevenueCategory whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\RevenueCategory whereGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\RevenueCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\RevenueCategory whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\RevenueCategory whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\RevenueCategory whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\RevenueCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\RevenueCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\RevenueCategory whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\RevenueCategory onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\RevenueCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\RevenueCategory withoutTrashed()
 */
class RevenueCategory extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'acc_revenue_category';

    protected $fillable = [
        'store_id',
        'group',
        'name'
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