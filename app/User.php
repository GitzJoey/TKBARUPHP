<?php

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Profile $profile
 * @property integer $store_id
 * @property integer $role_id
 * @property integer $profile_id
 * @method static \Illuminate\Database\Query\Builder|\App\User whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRoleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereProfileId($value)
 * @property-read \App\Store $store
 * @property-read \App\Role $role
 * @property-read \App\UserDetail $userDetail
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Settings[] $settings
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\EventCalendar[] $eventCalendars
 * @property string $api_token
 * @method static \Illuminate\Database\Query\Builder|\App\User whereApiToken($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Permission[] $permissions
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRoleIs($role = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePermissionIs($permission = '')
 * @property int $active
 * @property string|null $activation_token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereActivationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereActive($value)
 */
class User extends Authenticatable
{
    use LaratrustUserTrait;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'activation_token', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function profile() {
        return $this->hasOne('App\Model\Profile');
    }

    public function userDetail() {
        return $this->hasOne('App\Model\UserDetail');
    }

    public function store() {
        return $this->belongsTo('App\Model\Store', 'store_id');
    }

    public function settings() {
        return $this->hasMany('App\Model\Setting');
    }

    public function eventCalendars() {
        return $this->hasMany('App\Model\EventCalendar');
    }
}
