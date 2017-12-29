<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 9:32 PM
 */

namespace App\Model;

use Laratrust\Models\LaratrustPermission;

/**
 * App\Model\Permission
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Role[] $roles
 */
class Permission extends LaratrustPermission
{
    //
}