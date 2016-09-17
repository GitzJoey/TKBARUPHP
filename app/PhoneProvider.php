<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 11:06 AM
 */

namespace App;

use \Illuminate\Database\Eloquent\Model;

/**
 * App\PhoneProvider
 *
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereShortName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $prefix
 * @method static \Illuminate\Database\Query\Builder|\App\PhoneProvider wherePrefix($value)
 */
class PhoneProvider extends Model
{
    protected $table = "phone_provider";

    protected $fillable = [
        'name', 'short_name', 'prefix', 'status', 'remarks'
    ];

}