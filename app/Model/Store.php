<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/7/2016
 * Time: 9:46 AM
 */

namespace App\Model;

use Auth;
use Config;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Store
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone_num
 * @property string $fax_num
 * @property string $tax_id
 * @property string $status
 * @property string $is_default
 * @property string $frontweb
 * @property string $image_filename
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $products
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PurchaseOrder[] $purchaseOrders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BankAccount[] $bankAccounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Giro[] $giros
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store wherePhoneNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereFaxNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereTaxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereIsDefault($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereFrontweb($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereImageFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereDeletedAt($value)
 * @mixin \Eloquent
 * @property string $date_format
 * @property string $time_format
 * @property string $thousand_separator
 * @property string $decimal_separator
 * @property int $decimal_digit
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereDateFormat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereTimeFormat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereThousandSeparator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereDecimalSeparator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereDecimalDigit($value)
 * @property string $ribbon
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereRibbon($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\CurrenciesConversion[] $currenciesConversions
 * @property float $latitude
 * @property float $longitude
 * @property-read mixed $numeral_format
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store whereLongitude($value)
 * @property-read mixed $date_time_format
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Store withoutTrashed()
 */
class Store extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'stores';

    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'phone_num',
        'fax_num',
        'tax_id',
        'status',
        'is_default',
        'frontweb',
        'image_filename',
        'remarks',
        'date_format',
        'time_format',
        'thousand_separator',
        'decimal_separator',
        'decimal_digit',
        'ribbon'
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $appends = [
        'numeralFormat',
        'dateFormat',
        'timeFormat',
        'dateTimeformat'
    ];

    public function getNumeralFormatAttribute()
    {
        $thousandSeparator = is_null($this->attributes['thousand_separator']) ? ',':$this->attributes['thousand_separator'];
        $decimalSeparator = is_null($this->attributes['decimal_separator']) ? '.':$this->attributes['decimal_separator'];
        $decimalDigit = '';

        if ($this->attributes['decimal_digit'] == 0) {
            $decimalDigit = '00';
        } else {
            for ($i = 0; $i < $this->attributes['decimal_digit']; $i++) {
                $decimalDigit .= '0';
            }
        }

        return '0'.$thousandSeparator.'0'.'['.$decimalSeparator.']'.$decimalDigit;
    }

    public function getDateFormatAttribute()
    {
        if (is_null($this->attributes['date_format']) || empty($this->attributes['date_format'])) {
            return Config::get('const.DATETIME_FORMAT.PHP_DATE');
        } else {
            return $this->attributes['date_format'];
        }
    }

    public function getTimeFormatAttribute()
    {
        if (is_null($this->attributes['time_format']) || empty($this->attributes['time_format'])) {
            return Config::get('const.DATETIME_FORMAT.PHP_TIME');
        } else {
            return $this->attributes['time_format'];
        }
    }

    public function getDateTimeFormatAttribute()
    {
        return $this->getDateFormatAttribute() . ' ' . $this->getTimeFormatAttribute();
    }

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }

    public function purchaseOrders()
    {
        return $this->hasMany('App\Model\PurchaseOrder');
    }

    public function bankAccounts()
    {
        return $this->morphMany('App\Model\BankAccount', 'owner');
    }

    public function currenciesConversions()
    {
        return $this->hasMany('App\Model\CurrenciesConversion');
    }

    public function giros()
    {
        return $this->hasMany('App\Model\Giro');
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