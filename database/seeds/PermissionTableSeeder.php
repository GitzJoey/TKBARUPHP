<?php

/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 10:19 PM
 */

use Illuminate\Database\Seeder;

use App\Model\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permission = [
            [
                'name' => 'admin.user-list',
                'display_name' => '[User] Display User Listing',
                'description' => 'See only Listing Of User'
            ],
            [
                'name' => 'admin.user-create',
                'display_name' => '[User] Create User',
                'description' => 'Create New User'
            ],
            [
                'name' => 'admin.user-edit',
                'display_name' => '[User] Edit User',
                'description' => 'Edit User'
            ],
            [
                'name' => 'admin.user-delete',
                'display_name' => '[User] Delete User',
                'description' => 'Delete User'
            ],
            [
                'name' => 'admin.role-list',
                'display_name' => '[Role] Display Role Listing',
                'description' => 'See only Listing Of Role'
            ],
            [
                'name' => 'admin.role-create',
                'display_name' => '[Role] Create Role',
                'description' => 'Create New Role'
            ],
            [
                'name' => 'admin.role-edit',
                'display_name' => '[Role] Edit Role',
                'description' => 'Edit Role'
            ],
            [
                'name' => 'admin.role-delete',
                'display_name' => '[Role] Delete Role',
                'description' => 'Delete Role'
            ],
            [
                'name' => 'admin.store-list',
                'display_name' => '[Store] Display Store Listing',
                'description' => 'See only Listing Of Store'
            ],
            [
                'name' => 'admin.store-create',
                'display_name' => '[Store] Create Store',
                'description' => 'Create New Store'
            ],
            [
                'name' => 'admin.store-edit',
                'display_name' => '[Store] Edit Store',
                'description' => 'Edit Store'
            ],
            [
                'name' => 'admin.store-delete',
                'display_name' => '[Store] Delete Store',
                'description' => 'Delete Store'
            ],
            [
                'name' => 'admin.unit-list',
                'display_name' => '[Unit] Display Unit Listing',
                'description' => 'See only Listing Of Unit'
            ],
            [
                'name' => 'admin.unit-create',
                'display_name' => '[Unit] Create Unit',
                'description' => 'Create New Unit'
            ],
            [
                'name' => 'admin.unit-edit',
                'display_name' => '[Unit] Edit Unit',
                'description' => 'Edit Unit'
            ],
            [
                'name' => 'admin.unit-delete',
                'display_name' => '[Unit] Delete Unit',
                'description' => 'Delete Unit'
            ],
            [
                'name' => 'admin.settings-list',
                'display_name' => '[Settings] Display Settings Listing',
                'description' => 'See only Listing Of Settings'
            ],
            [
                'name' => 'admin.settings-edit',
                'display_name' => '[Settings] Edit Settings',
                'description' => 'Edit Settings'
            ],
            [
                'name' => 'admin.phoneprovider-list',
                'display_name' => '[Phone Provider] Display Phone Provider Listing',
                'description' => 'See only Listing Of Phone Provider'
            ],
            [
                'name' => 'admin.phoneprovider-create',
                'display_name' => '[Phone Provider] Create Phone Provider',
                'description' => 'Create New Phone Provider'
            ],
            [
                'name' => 'admin.phoneprovider-edit',
                'display_name' => '[Phone Provider] Edit Phone Provider',
                'description' => 'Edit Phone Provider'
            ],
            [
                'name' => 'admin.phoneprovider-delete',
                'display_name' => '[Phone Provider] Delete Phone Provider',
                'description' => 'Delete Phone Provider'
            ],
            [
                'name' => 'master.customer-list',
                'display_name' => '[Customer] Display Customer Listing',
                'description' => 'See only Listing Of Customer'
            ],
            [
                'name' => 'master.customer-create',
                'display_name' => '[Customer] Create Customer',
                'description' => 'Create New Customer'
            ],
            [
                'name' => 'master.customer-edit',
                'display_name' => '[Customer] Edit Customer',
                'description' => 'Edit Customer'
            ],
            [
                'name' => 'master.customer-delete',
                'display_name' => '[Customer] Delete Customer',
                'description' => 'Delete Customer'
            ],
            [
                'name' => 'master.supplier-list',
                'display_name' => '[Supplier] Display Supplier Listing',
                'description' => 'See only Listing Of Supplier'
            ],
            [
                'name' => 'master.supplier-create',
                'display_name' => '[Supplier] Create Supplier',
                'description' => 'Create New Supplier'
            ],
            [
                'name' => 'master.supplier-edit',
                'display_name' => '[Supplier] Edit Supplier',
                'description' => 'Edit Supplier'
            ],
            [
                'name' => 'master.supplier-delete',
                'display_name' => '[Supplier] Delete Supplier',
                'description' => 'Delete Supplier'
            ],
            [
                'name' => 'master.product-list',
                'display_name' => '[Product] Display Product Listing',
                'description' => 'See only Listing Of Product'
            ],
            [
                'name' => 'master.product-create',
                'display_name' => '[Product] Create Product',
                'description' => 'Create New Product'
            ],
            [
                'name' => 'master.product-edit',
                'display_name' => '[Product] Edit Product',
                'description' => 'Edit Product'
            ],
            [
                'name' => 'master.product-delete',
                'display_name' => '[Product] Delete Product',
                'description' => 'Delete Product'
            ],
            [
                'name' => 'employee.employee-list',
                'display_name' => '[Employee] Display Employee Listing',
                'description' => 'See only Listing Of Employee'
            ],
            [
                'name' => 'employee.employee-create',
                'display_name' => '[Employee] Create Employee',
                'description' => 'Create New Employee'
            ],
            [
                'name' => 'employee.employee-edit',
                'display_name' => '[Employee] Edit Employee',
                'description' => 'Edit Employee'
            ],
            [
                'name' => 'employee.employee-delete',
                'display_name' => '[Employee] Delete Employee',
                'description' => 'Delete Employee'
            ],
            [
                'name' => 'master.product.producttype-list',
                'display_name' => '[Product Type] Display Product Type Listing',
                'description' => 'See only Listing Of Product Type'
            ],
            [
                'name' => 'master.product.producttype-create',
                'display_name' => '[Product Type] Create Product Type',
                'description' => 'Create New Product Type'
            ],
            [
                'name' => 'master.product.producttype-edit',
                'display_name' => '[Product Type] Edit Product Type',
                'description' => 'Edit Product Type'
            ],
            [
                'name' => 'master.product.producttype-delete',
                'display_name' => '[Product Type] Delete Product Type',
                'description' => 'Delete Product Type'
            ],
            [
                'name' => 'master.warehouse-list',
                'display_name' => '[Warehouse] Display Warehouse Listing',
                'description' => 'See only Listing Of Warehouse'
            ],
            [
                'name' => 'master.warehouse-create',
                'display_name' => '[Warehouse] Create Warehouse',
                'description' => 'Create New Warehouse'
            ],
            [
                'name' => 'master.warehouse-edit',
                'display_name' => '[Warehouse] Edit Warehouse',
                'description' => 'Edit Warehouse'
            ],
            [
                'name' => 'master.warehouse-delete',
                'display_name' => '[Warehouse] Delete Warehouse',
                'description' => 'Delete Warehouse'
            ],
            [
                'name' => 'master.bank-list',
                'display_name' => '[Bank] Display Bank Listing',
                'description' => 'See only Listing Of Bank'
            ],
            [
                'name' => 'master.bank-create',
                'display_name' => '[Bank] Create Bank',
                'description' => 'Create New Bank'
            ],
            [
                'name' => 'master.bank-edit',
                'display_name' => '[Bank] Edit Bank',
                'description' => 'Edit Bank'
            ],
            [
                'name' => 'master.bank-delete',
                'display_name' => '[Bank] Delete Bank',
                'description' => 'Delete Bank'
            ],
            [
                'name' => 'master.truck-list',
                'display_name' => '[Truck] Display Truck Listing',
                'description' => 'See only Listing Of Truck'
            ],
            [
                'name' => 'master.truck-create',
                'display_name' => '[Truck] Create Truck',
                'description' => 'Create New Truck'
            ],
            [
                'name' => 'master.truck-edit',
                'display_name' => '[Truck] Edit Truck',
                'description' => 'Edit Truck'
            ],
            [
                'name' => 'master.truck-delete',
                'display_name' => '[Truck] Delete Truck',
                'description' => 'Delete Truck'
            ],
            [
                'name' => 'master.vendor.truck-list',
                'display_name' => '[Vendor Trucking] Display Vendor Truck Listing',
                'description' => 'See only Listing Of Vendor Truck'
            ],
            [
                'name' => 'master.vendor.truck-create',
                'display_name' => '[Vendor Trucking] Create Vendor Truck',
                'description' => 'Create New Vendor Truck'
            ],
            [
                'name' => 'master.vendor.truck-edit',
                'display_name' => '[Vendor Trucking] Edit Vendor Truck',
                'description' => 'Edit Vendor Truck'
            ],
            [
                'name' => 'master.vendor.truck-delete',
                'display_name' => '[Vendor Trucking] Delete Vendor Truck',
                'description' => 'Delete Vendor Truck'
            ],
            [
                'name' => 'master.expense_template-list',
                'display_name' => '[Expense Template] Display Expense Template Listing',
                'description' => 'See only Listing Of Expense Template'
            ],
            [
                'name' => 'master.expense_template-create',
                'display_name' => '[Expense Template] Create Expense Template',
                'description' => 'Create New Expense Template'
            ],
            [
                'name' => 'master.expense_template-edit',
                'display_name' => '[Expense Template] Edit Expense Template',
                'description' => 'Edit Expense Template'
            ],
            [
                'name' => 'master.expense_template-delete',
                'display_name' => '[Expense Template] Delete Expense Template',
                'description' => 'Delete Expense Template'
            ],
            [
                'name' => 'po.po-create',
                'display_name' => '[Purchase Order] Create PO',
                'description' => 'Enable Create PO'
            ],
            [
                'name' => 'po.po-revise',
                'display_name' => '[Purchase Order] Revise PO',
                'description' => 'Enable Revise PO'
            ],
            [
                'name' => 'po.po-payment',
                'display_name' => '[Purchase Order] Payment PO',
                'description' => 'Enable Payment PO'
            ],
            [
                'name' => 'po.po-copy',
                'display_name' => '[Purchase Order] PO Copy',
                'description' => 'Enable PO Copy'
            ],
            [
                'name' => 'so.so-create',
                'display_name' => '[Sales Order] Create SO',
                'description' => 'Enable Create SO'
            ],
            [
                'name' => 'so.so-revise',
                'display_name' => '[Sales Order] Revise SO',
                'description' => 'Enable Revise SO'
            ],
            [
                'name' => 'so.so-payment',
                'display_name' => '[Sales Order] Payment SO',
                'description' => 'Enable Payment SO'
            ],
            [
                'name' => 'so.so-copy',
                'display_name' => '[Sales Order] SO Copy',
                'description' => 'Enable SO Copy'
            ],
            [
                'name' => 'price.todayprice-list',
                'display_name' => '[Today Price] Display Today Price Listing',
                'description' => 'See only Listing Of Today Price'
            ],
            [
                'name' => 'price.todayprice-create',
                'display_name' => '[Today Price] Create New Today Price',
                'description' => 'Create New Today Price'
            ],
            [
                'name' => 'price.pricelevel-list',
                'display_name' => '[Price Level] Display Price Level Listing',
                'description' => 'See only Listing Of Price Level'
            ],
            [
                'name' => 'price.pricelevel-create',
                'display_name' => '[Price Level] Create Price Level',
                'description' => 'Create New Price Level'
            ],
            [
                'name' => 'price.pricelevel-edit',
                'display_name' => '[Price Level] Edit Price Level',
                'description' => 'Edit Price Level'
            ],
            [
                'name' => 'price.pricelevel-delete',
                'display_name' => '[Price Level] Delete Price Level',
                'description' => 'Delete Price Level'
            ],
            [
                'name' => 'warehouse.inflow-input',
                'display_name' => '[Warehouse Inflow] Input Warehouse Inflow',
                'description' => 'Enable Input Warehouse Inflow'
            ],
            [
                'name' => 'warehouse.outflow-input',
                'display_name' => '[Warehouse Outflow] Input Warehouse Outflow',
                'description' => 'Enable Input Warehouse Outflow'
            ],
            [
                'name' => 'warehouse.stockopname',
                'display_name' => '[Warehouse Stock Opname] Input Stock Opname',
                'description' => 'Enable Input Stock Opname'
            ],
            [
                'name' => 'warehouse.transfer-stock',
                'display_name' => '[Warehouse Transfer Stock] Input Transfer Stock',
                'description' => 'Enable Input Transfer Stock'
            ],
            [
                'name' => 'bank.upload',
                'display_name' => '[Bank] Upload Bank Data',
                'description' => 'Enable Upload Bank Data'
            ],
            [
                'name' => 'bank.consolidate',
                'display_name' => '[Bank] Consolidate Bank Data',
                'description' => 'Enable Consolidate Bank Data'
            ],
            [
                'name' => 'bank.giro',
                'display_name' => '[Bank Giro] Display Giro Listing',
                'description' => 'See only Listing Of Giro'
            ],
            [
                'name' => 'bank.giro-create',
                'display_name' => '[Bank Giro] Create Giro',
                'description' => 'Create Giro'
            ],
            [
                'name' => 'bank.giro-edit',
                'display_name' => '[Bank Giro] Edit Giro',
                'description' => 'Edit Giro'
            ],
            [
                'name' => 'bank.giro-delete',
                'display_name' => '[Bank Giro] Delete Giro',
                'description' => 'Delete Giro'
            ],
            [
                'name' => 'customer.confirmation',
                'display_name' => '[Customer] Customer Confirmation',
                'description' => 'Enable Customer Confirmation'
            ],
            [
                'name' => 'customer.payment',
                'display_name' => '[Customer] Customer Payment',
                'description' => 'Enable Customer Payment'
            ],
            [
                'name' => 'customer.approval',
                'display_name' => '[Customer] Customer Approval',
                'description' => 'Enable Customer Approval'
            ],
            [
                'name' => 'truck.maintenance-list',
                'display_name' => '[Truck Maintenance] Display Truck Maintenance Listing',
                'description' => 'See only Listing Of Truck Maintenance'
            ],
            [
                'name' => 'truck.maintenance-create',
                'display_name' => '[Truck Maintenance] Create Truck Maintenance',
                'description' => 'Create New Truck Maintenance'
            ],
            [
                'name' => 'truck.maintenance-edit',
                'display_name' => '[Truck Maintenance] Edit Truck Maintenance',
                'description' => 'Edit Truck Maintenance'
            ],
            [
                'name' => 'truck.maintenance-delete',
                'display_name' => '[Truck Maintenance] Delete Truck Maintenance',
                'description' => 'Delete Truck Maintenance'
            ],
            [
                'name' => 'report.admin-user',
                'display_name' => '[Report] Generate Report User',
                'description' => 'Generate Report User'
            ],
            [
                'name' => 'report.admin-role',
                'display_name' => '[Report] Generate Report Role',
                'description' => 'Generate Report Role'
            ],
            [
                'name' => 'report.admin-store',
                'display_name' => '[Report] Generate Report Store',
                'description' => 'Generate Report Store'
            ],
            [
                'name' => 'report.admin-unit',
                'display_name' => '[Report] Generate Report Unit',
                'description' => 'Generate Report Unit'
            ],
            [
                'name' => 'report.admin-phone_provider',
                'display_name' => '[Report] Generate Report Phone Provider',
                'description' => 'Generate Report Phone Provider'
            ],
            [
                'name' => 'report.admin-settings',
                'display_name' => '[Report] Generate Report Settings',
                'description' => 'Generate Report Settings'
            ],
            [
                'name' => 'report.master-supplier',
                'display_name' => '[Report] Generate Report Supplier',
                'description' => 'Generate Report Supplier'
            ],
            [
                'name' => 'report.master-customer',
                'display_name' => '[Report] Generate Report Customer',
                'description' => 'Generate Report Customer'
            ],
            [
                'name' => 'report.master-product',
                'display_name' => '[Report] Generate Report Product',
                'description' => 'Generate Report Product'
            ],
            [
                'name' => 'report.master-product_type',
                'display_name' => '[Report] Generate Report Product Type',
                'description' => 'Generate Report Product Type'
            ],
            [
                'name' => 'report.master-bank',
                'display_name' => '[Report] Generate Report Bank',
                'description' => 'Generate Report Bank'
            ],
            [
                'name' => 'report.master-warehouse',
                'display_name' => '[Report] Generate Report Warehouse',
                'description' => 'Generate Report Warehouse'
            ],
            [
                'name' => 'report.master-truck',
                'display_name' => '[Report] Generate Report Truck',
                'description' => 'Generate Report Truck'
            ],
            [
                'name' => 'report.master-truck_maintenance',
                'display_name' => '[Report] Generate Report Truck Maintenance',
                'description' => 'Generate Report Truck Maintenance'
            ],
            [
                'name' => 'report.master-vendor_trucking',
                'display_name' => '[Report] Generate Report Vendor Trucking',
                'description' => 'Generate Report Vendor Trucking'
            ],
            [
                'name' => 'report.trx-po',
                'display_name' => '[Report] Generate Report PO',
                'description' => 'Generate Report PO'
            ],
            [
                'name' => 'report.trx-so',
                'display_name' => '[Report] Generate Report Sales',
                'description' => 'Generate Report Sales'
            ],
        ];
        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }
}