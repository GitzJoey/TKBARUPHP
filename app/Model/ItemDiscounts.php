<?php

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\ItemDiscounts
 *
 * @property int $id
 * @property int $discountable_id
 * @property string $discountable_type
 * @property float $item_disc_percent
 * @property float $item_disc_value
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $discountable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts whereDiscountableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts whereDiscountableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts whereItemDiscPercent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts whereItemDiscValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDiscounts withoutTrashed()
 */
class ItemDiscounts extends Model
{
    use SoftDeletes;
	
    protected $dates = ['deleted_at'];
	
    protected $fillable = [
        'discountable_id',
        'discountable_type',
        'item_disc_percent',
        'item_disc_value'
    ];

    protected $hidden = [
        'discountable_type',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function discountable()
    {
        // SalesOrder | SalesOrderCopy | PurchaseOrder | PurchaseOrderCopy
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
