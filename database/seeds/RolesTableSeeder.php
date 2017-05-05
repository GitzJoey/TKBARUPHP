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
        /**
         *  Initializing The First 3 Roles
         *  1. Administrator (All Permissions)
         *  2. User (Only Show Menu Permissions But Not Including Admin Menu)
         *  3. Customer (Only Show Menu For Customer Confirmation And Customer Payment)
         */

        $all_permissions = Permission::get();
        $all_menu_permissions = Permission::where('name', 'like', 'menu-%')->get();
        $all_customer_menu_permissions = Permission::whereIn('name', array('menu-customer_confirmation', 'menu-customer_payment'))->get();

        $role_admin = new Role;
        $role_admin->name = 'admin';
        $role_admin->display_name = 'Administrator';
        $role_admin->description = 'Administrator';
        $role_admin->save();

        foreach ($all_permissions as $permission) {
            $role_admin->attachPermission($permission);
        }

        $role_user = new Role;
        $role_user->name = 'user';
        $role_user->display_name = 'User';
        $role_user->description = 'User';
        $role_user->save();

        foreach ($all_menu_permissions as $permission) {
            $role_user->attachPermission($permission);
        }

        $role_customer = new Role;
        $role_customer->name = 'customer';
        $role_customer->display_name = 'Customer';
        $role_customer->description = 'Customer';
        $role_customer->save();

        foreach ($all_customer_menu_permissions as $permission) {
            $role_customer->attachPermission($permission);
        }
    }
}
