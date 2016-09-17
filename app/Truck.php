<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:17 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Truck
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $plate_number
 * @property string $inspection_date
 * @property string $driver
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck wherePlateNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereInspectionDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereDriver($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereUpdatedAt($value)
 */
class Truck extends Model
{
    protected $table = 'truck';

    protected $fillable = [
        'plate_number', 'inspection_date', 'driver', 'status', 'remarks'
    ];
}