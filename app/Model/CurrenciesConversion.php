<?php

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CurrenciesConversion extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = 'currencies_conversion'; 
	protected $fillable = [
        'store_id',
        'currencies_id',
        'is_base',
        'conversion_value',
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
    public function currencies()
    {
        return $this->belongsTo('App\Model\CUrrencies', 'currencies_id');
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
