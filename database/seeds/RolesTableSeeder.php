<?php

/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 10:20 PM
 */

use Illuminate\Database\Seeder;

use App\Model\Role;
use App\Model\Permission;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        $role_admin = new Role;
        $role_admin->name = 'r_admin';
        $role_admin->display_name = 'Administrator';
        $role_admin->description = 'Administrator';

        $role_admin->save();

        $permission = Permission::get();
        $role_admin->permissions()->attach($permission);

        $role_user = new Role;
        $role_user->name = 'r_user';
        $role_user->display_name = 'User';
        $role_user->description = 'User';

        $role_user->save();

        $permission = Permission::get();
        $role_user->permissions()->attach($permission);

        $role_owner = new Role;
        $role_owner->name = 'r_owner';
        $role_owner->display_name = 'Owner';
        $role_owner->description = 'Owner';

        $role_owner->save();

        $permission = Permission::get();
        $role_owner->permissions()->attach($permission);

        $role_customer = new Role;
        $role_customer->name = 'r_customer';
        $role_customer->display_name = 'Customer';
        $role_customer->description = 'Customer';

        $role_customer->save();

        $permission = Permission::get();
        $role_customer->permissions()->attach($permission);
    }
}