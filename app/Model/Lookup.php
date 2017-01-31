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
 * App\Model\Lookup
 *
 * @property string $code
 * @property string $description
 * @property string $category
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Lookup whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Lookup whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Lookup whereCategory($value)
 * @mixin \Eloquent
 */
class Lookup extends Model
{
    protected $table = 'lookups';

    protected $appends = ['i18nDescription'];

    public $timestamps = false;

    protected $fillable = [
        'code',
        'description',
        'category'
    ];

    public function getI18nDescriptionAttribute()
    {
        return trans('lookup.'.$this->attributes['code']);
    }
}