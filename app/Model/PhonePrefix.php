<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/20/2016
 * Time: 9:07 AM
 */

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhonePrefix extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'phone_prefixes';

    protected $fillable = ['phone_provider_id', 'prefix'];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function providers()
    {
        $this->belongsTo('App\Model\PhoneProvider', 'phone_provider_id');
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