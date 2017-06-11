<?php

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\TaxItem
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
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereGst($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereItemableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereItemableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereLuxuryTax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereQty($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxItem whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class TaxItem extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'tax_items';

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

    public function itemable()
    {
        // Tax
        return $this->morphTo();
    }
}
