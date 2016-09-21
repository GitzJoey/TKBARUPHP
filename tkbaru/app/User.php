<?php

namespace App;

use \App\Profile;
use \App\UserDetail;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
 */
class User extends Authenticatable
{
    use EntrustUserTrait;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function profile() {
        return $this->hasOne('\App\Profile');
    }

    public function userDetail() {
        return $this->hasOne('\App\UserDetail');
    }

    public function store()
    {
        return $this->belongsTo('\App\Store', 'store_id');
    }

    public function role()
    {
        return $this->belongsToMany('\App\Role', 'role_user', 'user_id', 'role_id');
    }
}
