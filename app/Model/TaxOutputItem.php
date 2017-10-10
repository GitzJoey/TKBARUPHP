<?php

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\TaxOutputItem
 *
 * @property int $id
 * @property int $itemable_id
 * @property string $itemable_type
 * @property string $name
 * @property int $price
 * @property int $discount
 * @property int $qty
 * @property int $gst
 * @property int $luxury_tax
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $itemable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereGst($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereItemableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereItemableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereLuxuryTax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereQty($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereUpdatedBy($value)
 * @mixin \Eloquent
 * @property int $transactionable_id
 * @property string $transactionable_type
 * @property bool $is_gst_included
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $transactionable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereIsGstIncluded($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereTransactionableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem whereTransactionableType($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutputItem withoutTrashed()
 */
class TaxOutputItem extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'tax_output_items';

    protected $fillable = [
        'tax_id',
        'name',
        'is_gst_included',
        'price',
        'discount',
        'qty',
        'gst',
        'luxury_tax',
    ];

    protected $hidden = [
        'transactionable_type',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
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

    public function transactionable()
    {
        // TaxOutput
        return $this->morphTo();
    }
}
