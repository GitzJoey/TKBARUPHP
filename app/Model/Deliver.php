<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class Deliver extends Model
{
    use SoftDeletes;

    protected $table = 'delivers';

    protected $dates = ['deleted_at', 'deliver_date'];

    protected $fillable = [
        'item_id',
        'licence_plate',
        'deliver_date',
        'conversion_value',
        'brutto',
        'base_brutto',
        'selected_unit_id',
        'base_unit_id',
        'store_id'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function item()
    {
        return $this->belongsTo('App\Model\Item', 'item_id');
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
