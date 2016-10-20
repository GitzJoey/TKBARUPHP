<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 11:19 AM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Lookup
 *
 * @property string $code
 * @property string $description
 * @property string $category
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Lookup whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lookup whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lookup whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lookup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lookup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Lookup extends Model
{
    protected $table = 'lookup';

    public $timestamps = false;

    protected $fillable = [
        'code', 'description', 'category'
    ];

}