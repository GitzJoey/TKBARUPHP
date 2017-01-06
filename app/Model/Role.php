<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 9:32 PM
 */

namespace App\Model;

use Zizaco\Entrust\EntrustRole;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\Role
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Permission[] $perms
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Role whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends EntrustRole
{
    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Model\Permission', 'permission_role', 'role_id', 'permission_id');
    }
}