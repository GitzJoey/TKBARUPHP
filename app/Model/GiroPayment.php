<?php

namespace App\Model;

/**
 * App\Model\GiroPayment
 *
 * @property integer $id
 * @property integer $giro_id
 * @property-read \App\Model\Payment $payment
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payment_detail
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $payable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\GiroPayment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\GiroPayment whereGiroId($value)
 * @mixin \Eloquent
 */
class GiroPayment extends Payment
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
