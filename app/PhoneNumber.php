<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 11:05 AM
 */

namespace App;

use \Illuminate\Database\Eloquent\Model;

/**
 * App\PhoneNumber
 *
 * @mixin \Eloquent
 */
class PhoneNumber extends Model
{
	protected $table = 'phone';

	protected $fillable = ['phone_provider_id', 'number', 'status', 'remarks'];

    public function provider()
    {
    	return $this->belongsTo('App\PhoneProvider', 'phone_provider_id');
    }
}