<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 2/24/2017
 * Time: 5:11 AM
 */

namespace App\Model\Accounting;

use App\Traits\StoreFilter;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashFlow extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'acc_cash_flow';

    protected $appends = ['codeAndName'];

    protected $fillable = [
        'store_id',
        'from_cash_account_id',
        'to_cash_account_id',
        'amount',
        'remarks',
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

    public function fromCashAccount()
    {
        return $this->belongsTo('App\Model\Accounting\CashAccount', 'from_cash_account_id');
    }

    public function toCashAccount()
    {
        return $this->belongsTo('App\Model\Accounting\CashAccount', 'to_cash_account_id');
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