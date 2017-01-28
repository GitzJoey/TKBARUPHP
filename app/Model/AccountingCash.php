<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 1/28/2017
 * Time: 11:57 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class AccountingCash extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'acc_cash';

    protected $fillable = [
        'store_id',
        'code',
        'name',
        'is_default',
        'status',
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