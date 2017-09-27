<?php

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\Tax
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TaxItem[] $items
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereGst($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereGstTransactionType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereGstType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereInvoiceDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereInvoiceNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereLuxuryTax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereOpponentAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereOpponentName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereOpponentTaxIdNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereReference($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereTaxBase($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereTaxIdNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereTransactionDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereTransactionDoc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Tax whereYear($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TaxItem[] $transactions
 */
class Tax extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'taxes';

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
        'gst_type',
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
        return $this->morphMany(TaxItem::class, 'transactionable');
    }
}
