<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/22/2016
 * Time: 12:34 PM
 */

namespace App\Model;

use Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\EventCalendar
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $start_date
 * @property string $end_date
 * @property string $event_title
 * @property string $ext_url
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar whereEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar whereEventTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar whereExtUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $start
 * @property-read mixed $title
 * @property-read mixed $end
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventCalendar withoutTrashed()
 */
class EventCalendar extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'user_calendar_events';

    protected $fillable = [
        'user_id', 'start_date', 'end_date', 'event_title', 'ext_url'
    ];

    protected $appends = [
        'start', 'end', 'title'
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function getStartAttribute()
    {
        return $this->attributes['start_date'];
    }

    public function getTitleAttribute()
    {
        return $this->attributes['event_title'];
    }

    public function getEndAttribute()
    {
        return $this->attributes['end_date'];
    }

    public function user()
    {
        return $this->belongsTo('App\User');
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