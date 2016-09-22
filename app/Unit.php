<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 10:30 PM
 */

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Unit
 *
 * @property integer $id
 * @property string $name
 * @property string $symbol
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereSymbol($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Unit extends Model
{
    protected $table = 'unit';

    protected $fillable = [
        'name', 'symbol', 'status', 'remarks',
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }
}