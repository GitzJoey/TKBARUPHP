<?php

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\TaxOutput
 *
 * @property int $id
 * @property string $invoice_no
 * @property string $invoice_date
 * @property string $gst_transaction_type
 * @property string $transaction_doc
 * @property string $transaction_detail
 * @property int $month
 * @property int $year
 * @property string $tax_id_no
 * @property string $name
 * @property string $address
 * @property string $opponent_tax_id_no
 * @property string $opponent_name
 * @property string $opponent_address
 * @property string $gst_type
 * @property int $tax_base
 * @property int $gst
 * @property int $luxury_tax
 * @property string $reference
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TaxOutputItem[] $items
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereGst($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereGstTransactionType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereGstType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereInvoiceDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereInvoiceNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereLuxuryTax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereOpponentAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereOpponentName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereOpponentTaxIdNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereReference($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereTaxBase($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereTaxIdNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereTransactionDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereTransactionDoc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput whereYear($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TaxOutputItem[] $transactions
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TaxOutput withoutTrashed()
 */
class TaxOutput extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'tax_outputs';

    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'gst_transaction_type',
        'transaction_doc',
        'transaction_detail',
        'month',
        'year',
        'tax_id_no',
        'name',
        'address',
        'opponent_tax_id_no',
        'opponent_name',
        'opponent_address',
        'tax_base',
        'gst',
        'luxury_tax',
        'reference',
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

    public function transactions()
    {
        return $this->morphMany(TaxOutputItem::class, 'transactionable');
    }
}
