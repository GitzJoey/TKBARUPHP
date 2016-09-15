<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 9:32 PM
 */

namespace App;

use Zizaco\Entrust\EntrustRole;

/**
 * App\Role
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $perms
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends EntrustRole
{
    public function permissionList() {
        return $this->belongsToMany('\App\Permission', 'permission_role', 'role_id', 'permission_id');
    }
}