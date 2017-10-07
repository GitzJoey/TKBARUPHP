<?php

namespace App\Model;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Model\Currencies
 *
 * @property int $id
 * @property string $name
 * @property string $symbol
 * @property string $status
 * @property string $remarks
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies whereSymbol($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Currencies withoutTrashed()
 */
class Currencies extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $table = 'currencies';

	protected $fillable = [
        'name',
        'symbol',
        'status',
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
