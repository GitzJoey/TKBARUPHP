<?php

namespace App\Model;

/**
 * App\Model\CashPayment
 *
 * @property integer $id
 * @property-read \App\Model\Payment $payment
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payment_detail
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CashPayment whereId($value)
 * @mixin \Eloquent
 */
class CashPayment extends Payment
{
    public $timestamps = false;

    public function payment(){
        return $this->morphOne('App\Model\Payment', 'payment_detail');
    }

    public static function boot()
    {
        static::creating(function ($model) {
        });

        static::updating(function ($model) {
        });

        static::deleting(function ($model) {
        });
    }
}
