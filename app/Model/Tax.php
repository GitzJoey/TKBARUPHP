<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'taxes';

    protected $appends = ['hId'];

    protected $fillable = [
        'tax_id_no',
        'name',
        'invoice_no',
        'invoice_date',
        'code_type',
        'month',
        'year',
        'invoice_status',
        'tax_base',
        'value_added_tax,',
        'sales_tax_on_luxury_goods,',
        'approval_status,',
        'approval_date,',
        'description,',
        'signature,',
        'reference,',
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function getHIdAttribute()
    {
        return $this->hId();
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
