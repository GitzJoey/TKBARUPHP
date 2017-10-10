<?php

namespace App\Model;

use Auth;
use App\Traits\StoreFilter;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Giro
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $bank_id
 * @property string $serial_number
 * @property string $effective_date
 * @property float $amount
 * @property string $printed_name
 * @property string $status
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Store $store
 * @property-read \App\Model\Bank $bank
 * @property-read \App\Model\GiroPayment $giroPayment
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereBankId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereSerialNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereEffectiveDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro wherePrintedName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Giro withoutTrashed()
 */
class Giro extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'store_id',
        'bank_id',
        'serial_number',
        'effective_date',
        'amount',
        'printed_name',
        'status',
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

    public function store()
    {
        return $this->belongsTo('App\Model\Store', 'store_id');
    }

    public function bank()
    {
        return $this->belongsTo('App\Model\Bank', 'bank_id');
    }

    public function giroPayment()
    {
        return $this->hasOne('App\Model\GiroPayment');
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
