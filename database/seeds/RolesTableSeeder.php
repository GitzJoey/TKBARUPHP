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
        $permissionMap = [
            'admin' => [
                'user-list',
                'user-create',
                'user-edit',
                'user-delete',
                'role-list',
                'role-create',
                'role-edit',
                'role-delete',
                'store-list',
                'store-create',
                'store-edit',
                'store-delete',
                'unit-list',
                'unit-create',
                'unit-edit',
                'unit-delete',
                'currencies-list',
                'currencies-create',
                'currencies-edit',
                'currencies-delete',
                'settings-list',
                'settings-edit',
                'phone_provider-list',
                'phone_provider-create',
                'phone_provider-edit',
                'phone_provider-delete',
                'report-user',
                'report-role',
                'report-store',
                'report-unit',
                'report-phone_provider',
                'report-settings',
            ],
            'master' => [
                'customer-list',
                'customer-create',
                'customer-edit',
                'customer-delete',
                'supplier-list',
                'supplier-create',
                'supplier-edit',
                'supplier-delete',
                'product-list',
                'product-create',
                'product-edit',
                'product-delete',
                'employee-list',
                'employee-create',
                'employee-edit',
                'employee-delete',
                'employee_salary-list',
                'employee_salary-generate',
                'employee_salary-create',
                'employee_salary-show',
                'product_type-list',
                'product_type-create',
                'product_type-edit',
                'product_type-delete',
                'warehouse-list',
                'warehouse-create',
                'warehouse-edit',
                'warehouse-delete',
                'bank-list',
                'bank-create',
                'bank-edit',
                'bank-delete',
                'truck-list',
                'truck-create',
                'truck-edit',
                'truck-delete',
                'truck_vendor-list',
                'truck_vendor-create',
                'truck_vendor-edit',
                'truck_vendor-delete',
                'expense_template-list',
                'expense_template-create',
                'expense_template-edit',
                'expense_template-delete',
                'so-create',
                'so-revise',
                'so-payment',
                'so-copy',
                'today_price-list',
                'today_price-create',
                'price_level-list',
                'price_level-create',
                'price_level-edit',
                'price_level-delete',
                'warehouse_input-inflow',
                'warehouse_input-outflow',
                'warehouse_input-stock_opname',
                'warehouse_input-transfer_stock',
                'bank_data-upload',
                'bank_data-consolidate',
                'bank_giro-list',
                'bank_giro-create',
                'bank_giro-edit',
                'bank_giro-delete',
                'truck_maintenance-list',
                'truck_maintenance-create',
                'truck_maintenance-edit',
                'truck_maintenance-delete',
                'report-supplier',
                'report-customer',
                'report-product',
                'report-product_type',
                'report-bank',
                'report-warehouse',
                'report-truck',
                'report-truck_maintenance',
                'report-vendor_trucking',
                'report-so',
                'report-stock_history',
            ],
            'customer' => [
                'customer-confirmation',
                'customer-payment',
                'customer-approval',
                'po-create',
                'po-revise',
                'po-payment',
                'po-copy',
                'report-po',
            ],
            'user' => [
                'user-list',
                'user-edit',
            ],
        ];

        $role_admin = new Role;
        $role_admin->name = 'admin';
        $role_admin->display_name = 'Administrator';
        $role_admin->description = 'Administrator';
        $role_admin->save();

        $this->setPermission($role_admin, $permissionMap['admin']);

        $role_master = new Role;
        $role_master->name = 'master';
        $role_master->display_name = 'Master';
        $role_master->description = 'Master';
        $role_master->save();

        $this->setPermission($role_master, $permissionMap['master']);

        $role_user = new Role;
        $role_user->name = 'user';
        $role_user->display_name = 'User';
        $role_user->description = 'User';
        $role_user->save();

        $this->setPermission($role_user, $permissionMap['user']);

        $role_customer = new Role;
        $role_customer->name = 'customer';
        $role_customer->display_name = 'Customer';
        $role_customer->description = 'Customer';
        $role_customer->save();

        $this->setPermission($role_customer, $permissionMap['customer']);
    }

    protected function setPermission(Role $roleModel, $permissions) {
        foreach ($permissions as $permission) {
            $p = Permission::where('name', $permission)->first();
            $roleModel->attachPermission($p);
            $this->command->info($roleModel->display_name.' ('.$roleModel->name.') can: '.$p->display_name. ' ('.$p->name.')');
        }
    }
}
