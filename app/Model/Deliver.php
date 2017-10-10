<?php

namespace App\Model;

use App\Traits\StoreFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\Deliver
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $item_id
 * @property integer $selected_unit_id
 * @property integer $base_unit_id
 * @property float $conversion_value
 * @property \Carbon\Carbon $deliver_date
 * @property \Carbon\Carbon $confirm_receive_date
 * @property float $brutto
 * @property float $base_brutto
 * @property float $netto
 * @property float $base_netto
 * @property float $tare
 * @property float $base_tare
 * @property string $license_plate
 * @property string $article_code
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Item $item
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereSelectedUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereBaseUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereConversionValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereDeliverDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereConfirmReceiveDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereBrutto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereBaseBrutto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereNetto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereBaseNetto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereTare($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereBaseTare($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereLicensePlate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereArticleCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Deliver withoutTrashed()
 */
class Deliver extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $table = 'delivers';

    protected $dates = ['deleted_at', 'deliver_date', 'confirm_receive_date'];

    protected $fillable = [
        'item_id',
        'license_plate',
        'deliver_date',
        'confirm_receive_date',
        'conversion_value',
        'brutto',
        'base_brutto',
        'netto',
        'base_netto',
        'tare',
        'base_tare',
        'selected_unit_id',
        'base_unit_id',
        'store_id',
        'remarks'
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
