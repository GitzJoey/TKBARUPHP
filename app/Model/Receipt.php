<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\Receipt
 *
 * @property integer $id
 * @property \Carbon\Carbon $receipt_date
 * @property float $brutto
 * @property float $netto
 * @property float $tare
 * @property string $licence_plate
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $item_id
 * @property integer $store_id
 * @property integer $selected_unit_id
 * @property-read \App\Model\Item $item
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereReceiptDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereBrutto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereNetto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereTare($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereLicencePlate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereSelectedUnitId($value)
 * @mixin \Eloquent
 * @property integer $base_unit_id
 * @property float $base_brutto
 * @property float $base_netto
 * @property float $base_tare
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereBaseUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereBaseBrutto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereBaseNetto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereBaseTare($value)
 * @property float $conversion_value
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereConversionValue($value)
 */
class Receipt extends Model
{
    use SoftDeletes;

    protected $table = 'receipts';

    protected $dates = ['deleted_at', 'receipt_date'];

    protected $fillable = [
        'item_id',
        'licence_plate',
        'receipt_date',
        'conversion_value',
        'brutto',
        'base_brutto',
        'netto',
        'base_netto',
        'tare',
        'base_tare',
        'selected_unit_id',
        'base_unit_id',
        'store_id'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function item()
    {
        return $this->belongsTo('App\Model\Item', 'item_id');
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
