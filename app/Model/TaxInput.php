<?php

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\TaxInput
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $invoice_no
 * @property string $invoice_date
 * @property int $month
 * @property int $year
 * @property int $is_creditable
 * @property string $opponent_tax_id_no
 * @property string $opponent_name
 * @property int $tax_base
 * @property int $gst
 * @property int $luxury_tax
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxInput onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereGst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereInvoiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereInvoiceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereIsCreditable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereLuxuryTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereOpponentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereOpponentTaxIdNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereTaxBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxInput withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxInput withoutTrashed()
 * @property string $detail
 * @property int $qty
 * @property int $unit_price
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaxInput whereUnitPrice($value)
 */
class TaxInput extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'tax_inputs';

    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'month',
        'year',
        'is_creditable',
        'opponent_tax_id_no',
        'opponent_name',
        'detail',
        'qty',
        'unit_price',
        'tax_base',
        'gst',
        'luxury_tax'
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

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }
}
