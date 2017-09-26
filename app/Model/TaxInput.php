<?php

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\TaxInput
 *
 * @mixin \Eloquent
 */
class TaxInput extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'tax_inputs';

    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'month',
        'year',
        'is_creditable',
        'opponent_tax_id_no',
        'opponent_name',
        'tax_base',
        'gst',
        'luxury_tax'
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

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

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }
}
