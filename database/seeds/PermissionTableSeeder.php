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
                'name' => 'user-list',
                'display_name' => '[User] Display User Listing',
                'description' => 'See only Listing Of User'
            ],
            [
                'name' => 'user-create',
                'display_name' => '[User] Create User',
                'description' => 'Create New User'
            ],
            [
                'name' => 'user-edit',
                'display_name' => '[User] Edit User',
                'description' => 'Edit User'
            ],
            [
                'name' => 'user-delete',
                'display_name' => '[User] Delete User',
                'description' => 'Delete User'
            ],
            [
                'name' => 'role-list',
                'display_name' => '[Role] Display Role Listing',
                'description' => 'See only Listing Of Role'
            ],
            [
                'name' => 'role-create',
                'display_name' => '[Role] Create Role',
                'description' => 'Create New Role'
            ],
            [
                'name' => 'role-edit',
                'display_name' => '[Role] Edit Role',
                'description' => 'Edit Role'
            ],
            [
                'name' => 'role-delete',
                'display_name' => '[Role] Delete Role',
                'description' => 'Delete Role'
            ],
            [
                'name' => 'store-list',
                'display_name' => '[Store] Display Store Listing',
                'description' => 'See only Listing Of Store'
            ],
            [
                'name' => 'store-create',
                'display_name' => '[Store] Create Store',
                'description' => 'Create New Store'
            ],
            [
                'name' => 'store-edit',
                'display_name' => '[Store] Edit Store',
                'description' => 'Edit Store'
            ],
            [
                'name' => 'store-delete',
                'display_name' => '[Store] Delete Store',
                'description' => 'Delete Store'
            ],
            [
                'name' => 'unit-list',
                'display_name' => '[Unit] Display Unit Listing',
                'description' => 'See only Listing Of Unit'
            ],
            [
                'name' => 'unit-create',
                'display_name' => '[Unit] Create Unit',
                'description' => 'Create New Unit'
            ],
            [
                'name' => 'unit-edit',
                'display_name' => '[Unit] Edit Unit',
                'description' => 'Edit Unit'
            ],
            [
                'name' => 'unit-delete',
                'display_name' => '[Unit] Delete Unit',
                'description' => 'Delete Unit'
            ],
            [
                'name' => 'currencies-list',
                'display_name' => '[Currencies] Display Currencies Listing',
                'description' => 'See only Listing Of Currencies'
            ],
            [
                'name' => 'currencies-create',
                'display_name' => '[Currencies] Create Currencies',
                'description' => 'Create New Currencies'
            ],
            [
                'name' => 'currencies-edit',
                'display_name' => '[Currencies] Edit Currencies',
                'description' => 'Edit Currencies'
            ],
            [
                'name' => 'currencies-delete',
                'display_name' => '[Currencies] Delete Currencies',
                'description' => 'Delete Currencies'
            ],
            [
                'name' => 'settings-list',
                'display_name' => '[Settings] Display Settings Listing',
                'description' => 'See only Listing Of Settings'
            ],
            [
                'name' => 'settings-edit',
                'display_name' => '[Settings] Edit Settings',
                'description' => 'Edit Settings'
            ],
            [
                'name' => 'phone_provider-list',
                'display_name' => '[Phone Provider] Display Phone Provider Listing',
                'description' => 'See only Listing Of Phone Provider'
            ],
            [
                'name' => 'phone_provider-create',
                'display_name' => '[Phone Provider] Create Phone Provider',
                'description' => 'Create New Phone Provider'
            ],
            [
                'name' => 'phone_provider-edit',
                'display_name' => '[Phone Provider] Edit Phone Provider',
                'description' => 'Edit Phone Provider'
            ],
            [
                'name' => 'phone_provider-delete',
                'display_name' => '[Phone Provider] Delete Phone Provider',
                'description' => 'Delete Phone Provider'
            ],
            [
                'name' => 'customer-list',
                'display_name' => '[Customer] Display Customer Listing',
                'description' => 'See only Listing Of Customer'
            ],
            [
                'name' => 'customer-create',
                'display_name' => '[Customer] Create Customer',
                'description' => 'Create New Customer'
            ],
            [
                'name' => 'customer-edit',
                'display_name' => '[Customer] Edit Customer',
                'description' => 'Edit Customer'
            ],
            [
                'name' => 'customer-delete',
                'display_name' => '[Customer] Delete Customer',
                'description' => 'Delete Customer'
            ],
            [
                'name' => 'supplier-list',
                'display_name' => '[Supplier] Display Supplier Listing',
                'description' => 'See only Listing Of Supplier'
            ],
            [
                'name' => 'supplier-create',
                'display_name' => '[Supplier] Create Supplier',
                'description' => 'Create New Supplier'
            ],
            [
                'name' => 'supplier-edit',
                'display_name' => '[Supplier] Edit Supplier',
                'description' => 'Edit Supplier'
            ],
            [
                'name' => 'supplier-delete',
                'display_name' => '[Supplier] Delete Supplier',
                'description' => 'Delete Supplier'
            ],
            [
                'name' => 'product-list',
                'display_name' => '[Product] Display Product Listing',
                'description' => 'See only Listing Of Product'
            ],
            [
                'name' => 'product-create',
                'display_name' => '[Product] Create Product',
                'description' => 'Create New Product'
            ],
            [
                'name' => 'product-edit',
                'display_name' => '[Product] Edit Product',
                'description' => 'Edit Product'
            ],
            [
                'name' => 'product-delete',
                'display_name' => '[Product] Delete Product',
                'description' => 'Delete Product'
            ],
            [
                'name' => 'employee-list',
                'display_name' => '[Employee] Display Employee Listing',
                'description' => 'See only Listing Of Employee'
            ],
            [
                'name' => 'employee-create',
                'display_name' => '[Employee] Create Employee',
                'description' => 'Create New Employee'
            ],
            [
                'name' => 'employee-edit',
                'display_name' => '[Employee] Edit Employee',
                'description' => 'Edit Employee'
            ],
            [
                'name' => 'employee-delete',
                'display_name' => '[Employee] Delete Employee',
                'description' => 'Delete Employee'
            ],
            [
                'name' => 'employee_salary-list',
                'display_name' => '[Employee Salary] List Employee Salary',
                'description' => 'See only Listing Employee Salary'
            ],
            [
                'name' => 'employee_salary-generate',
                'display_name' => '[Employee Salary] Generate Salary',
                'description' => 'Generate Employee Salary'
            ],
            [
                'name' => 'employee_salary-create',
                'display_name' => '[Employee Salary] Create Employee Salary Record',
                'description' => 'Create New Employee Salary Record'
            ],
            [
                'name' => 'employee_salary-show',
                'display_name' => '[Employee Salary] Show Employee Salary Record',
                'description' => 'Show Employee Salary Record'
            ],
            [
                'name' => 'product_type-list',
                'display_name' => '[Product Type] Display Product Type Listing',
                'description' => 'See only Listing Of Product Type'
            ],
            [
                'name' => 'product_type-create',
                'display_name' => '[Product Type] Create Product Type',
                'description' => 'Create New Product Type'
            ],
            [
                'name' => 'product_type-edit',
                'display_name' => '[Product Type] Edit Product Type',
                'description' => 'Edit Product Type'
            ],
            [
                'name' => 'product_type-delete',
                'display_name' => '[Product Type] Delete Product Type',
                'description' => 'Delete Product Type'
            ],
            [
                'name' => 'warehouse-list',
                'display_name' => '[Warehouse] Display Warehouse Listing',
                'description' => 'See only Listing Of Warehouse'
            ],
            [
                'name' => 'warehouse-create',
                'display_name' => '[Warehouse] Create Warehouse',
                'description' => 'Create New Warehouse'
            ],
            [
                'name' => 'warehouse-edit',
                'display_name' => '[Warehouse] Edit Warehouse',
                'description' => 'Edit Warehouse'
            ],
            [
                'name' => 'warehouse-delete',
                'display_name' => '[Warehouse] Delete Warehouse',
                'description' => 'Delete Warehouse'
            ],
            [
                'name' => 'bank-list',
                'display_name' => '[Bank] Display Bank Listing',
                'description' => 'See only Listing Of Bank'
            ],
            [
                'name' => 'bank-create',
                'display_name' => '[Bank] Create Bank',
                'description' => 'Create New Bank'
            ],
            [
                'name' => 'bank-edit',
                'display_name' => '[Bank] Edit Bank',
                'description' => 'Edit Bank'
            ],
            [
                'name' => 'bank-delete',
                'display_name' => '[Bank] Delete Bank',
                'description' => 'Delete Bank'
            ],
            [
                'name' => 'truck-list',
                'display_name' => '[Truck] Display Truck Listing',
                'description' => 'See only Listing Of Truck'
            ],
            [
                'name' => 'truck-create',
                'display_name' => '[Truck] Create Truck',
                'description' => 'Create New Truck'
            ],
            [
                'name' => 'truck-edit',
                'display_name' => '[Truck] Edit Truck',
                'description' => 'Edit Truck'
            ],
            [
                'name' => 'truck-delete',
                'display_name' => '[Truck] Delete Truck',
                'description' => 'Delete Truck'
            ],
            [
                'name' => 'truck_vendor-list',
                'display_name' => '[Vendor Trucking] Display Vendor Truck Listing',
                'description' => 'See only Listing Of Vendor Truck'
            ],
            [
                'name' => 'truck_vendor-create',
                'display_name' => '[Vendor Trucking] Create Vendor Truck',
                'description' => 'Create New Vendor Truck'
            ],
            [
                'name' => 'truck_vendor-edit',
                'display_name' => '[Vendor Trucking] Edit Vendor Truck',
                'description' => 'Edit Vendor Truck'
            ],
            [
                'name' => 'truck_vendor-delete',
                'display_name' => '[Vendor Trucking] Delete Vendor Truck',
                'description' => 'Delete Vendor Truck'
            ],
            [
                'name' => 'expense_template-list',
                'display_name' => '[Expense Template] Display Expense Template Listing',
                'description' => 'See only Listing Of Expense Template'
            ],
            [
                'name' => 'expense_template-create',
                'display_name' => '[Expense Template] Create Expense Template',
                'description' => 'Create New Expense Template'
            ],
            [
                'name' => 'expense_template-edit',
                'display_name' => '[Expense Template] Edit Expense Template',
                'description' => 'Edit Expense Template'
            ],
            [
                'name' => 'expense_template-delete',
                'display_name' => '[Expense Template] Delete Expense Template',
                'description' => 'Delete Expense Template'
            ],
            [
                'name' => 'po-create',
                'display_name' => '[Purchase Order] Create PO',
                'description' => 'Enable Create PO'
            ],
            [
                'name' => 'po-revise',
                'display_name' => '[Purchase Order] Revise PO',
                'description' => 'Enable Revise PO'
            ],
            [
                'name' => 'po-payment',
                'display_name' => '[Purchase Order] Payment PO',
                'description' => 'Enable Payment PO'
            ],
            [
                'name' => 'po-copy',
                'display_name' => '[Purchase Order] PO Copy',
                'description' => 'Enable PO Copy'
            ],
            [
                'name' => 'so-create',
                'display_name' => '[Sales Order] Create SO',
                'description' => 'Enable Create SO'
            ],
            [
                'name' => 'so-revise',
                'display_name' => '[Sales Order] Revise SO',
                'description' => 'Enable Revise SO'
            ],
            [
                'name' => 'so-payment',
                'display_name' => '[Sales Order] Payment SO',
                'description' => 'Enable Payment SO'
            ],
            [
                'name' => 'so-copy',
                'display_name' => '[Sales Order] SO Copy',
                'description' => 'Enable SO Copy'
            ],
            [
                'name' => 'today_price-list',
                'display_name' => '[Today Price] Display Today Price Listing',
                'description' => 'See only Listing Of Today Price'
            ],
            [
                'name' => 'today_price-create',
                'display_name' => '[Today Price] Create New Today Price',
                'description' => 'Create New Today Price'
            ],
            [
                'name' => 'price_level-list',
                'display_name' => '[Price Level] Display Price Level Listing',
                'description' => 'See only Listing Of Price Level'
            ],
            [
                'name' => 'price_level-create',
                'display_name' => '[Price Level] Create Price Level',
                'description' => 'Create New Price Level'
            ],
            [
                'name' => 'price_level-edit',
                'display_name' => '[Price Level] Edit Price Level',
                'description' => 'Edit Price Level'
            ],
            [
                'name' => 'price_level-delete',
                'display_name' => '[Price Level] Delete Price Level',
                'description' => 'Delete Price Level'
            ],
            [
                'name' => 'warehouse_input-inflow',
                'display_name' => '[Warehouse Inflow] Input Warehouse Inflow',
                'description' => 'Enable Input Warehouse Inflow'
            ],
            [
                'name' => 'warehouse_input-outflow',
                'display_name' => '[Warehouse Outflow] Input Warehouse Outflow',
                'description' => 'Enable Input Warehouse Outflow'
            ],
            [
                'name' => 'warehouse_input-stock_opname',
                'display_name' => '[Warehouse Stock Opname] Input Stock Opname',
                'description' => 'Enable Input Stock Opname'
            ],
            [
                'name' => 'warehouse_input-transfer_stock',
                'display_name' => '[Warehouse Transfer Stock] Input Transfer Stock',
                'description' => 'Enable Input Transfer Stock'
            ],
            [
                'name' => 'bank_data-upload',
                'display_name' => '[Bank] Upload Bank Data',
                'description' => 'Enable Upload Bank Data'
            ],
            [
                'name' => 'bank_data-consolidate',
                'display_name' => '[Bank] Consolidate Bank Data',
                'description' => 'Enable Consolidate Bank Data'
            ],
            [
                'name' => 'bank_giro-list',
                'display_name' => '[Bank Giro] Display Giro Listing',
                'description' => 'See only Listing Of Giro'
            ],
            [
                'name' => 'bank_giro-create',
                'display_name' => '[Bank Giro] Create Giro',
                'description' => 'Create Giro'
            ],
            [
                'name' => 'bank_giro-edit',
                'display_name' => '[Bank Giro] Edit Giro',
                'description' => 'Edit Giro'
            ],
            [
                'name' => 'bank_giro-delete',
                'display_name' => '[Bank Giro] Delete Giro',
                'description' => 'Delete Giro'
            ],
            [
                'name' => 'customer-confirmation',
                'display_name' => '[Customer] Customer Confirmation',
                'description' => 'Enable Customer Confirmation'
            ],
            [
                'name' => 'customer-payment',
                'display_name' => '[Customer] Customer Payment',
                'description' => 'Enable Customer Payment'
            ],
            [
                'name' => 'customer-approval',
                'display_name' => '[Customer] Customer Approval',
                'description' => 'Enable Customer Approval'
            ],
            [
                'name' => 'truck_maintenance-list',
                'display_name' => '[Truck Maintenance] Display Truck Maintenance Listing',
                'description' => 'See only Listing Of Truck Maintenance'
            ],
            [
                'name' => 'truck_maintenance-create',
                'display_name' => '[Truck Maintenance] Create Truck Maintenance',
                'description' => 'Create New Truck Maintenance'
            ],
            [
                'name' => 'truck_maintenance-edit',
                'display_name' => '[Truck Maintenance] Edit Truck Maintenance',
                'description' => 'Edit Truck Maintenance'
            ],
            [
                'name' => 'truck_maintenance-delete',
                'display_name' => '[Truck Maintenance] Delete Truck Maintenance',
                'description' => 'Delete Truck Maintenance'
            ],
            [
                'name' => 'report-user',
                'display_name' => '[Report] Generate Report User',
                'description' => 'Generate Report User'
            ],
            [
                'name' => 'report-role',
                'display_name' => '[Report] Generate Report Role',
                'description' => 'Generate Report Role'
            ],
            [
                'name' => 'report-store',
                'display_name' => '[Report] Generate Report Store',
                'description' => 'Generate Report Store'
            ],
            [
                'name' => 'report-unit',
                'display_name' => '[Report] Generate Report Unit',
                'description' => 'Generate Report Unit'
            ],
            [
                'name' => 'report-phone_provider',
                'display_name' => '[Report] Generate Report Phone Provider',
                'description' => 'Generate Report Phone Provider'
            ],
            [
                'name' => 'report-settings',
                'display_name' => '[Report] Generate Report Settings',
                'description' => 'Generate Report Settings'
            ],
            [
                'name' => 'report-supplier',
                'display_name' => '[Report] Generate Report Supplier',
                'description' => 'Generate Report Supplier'
            ],
            [
                'name' => 'report-customer',
                'display_name' => '[Report] Generate Report Customer',
                'description' => 'Generate Report Customer'
            ],
            [
                'name' => 'report-product',
                'display_name' => '[Report] Generate Report Product',
                'description' => 'Generate Report Product'
            ],
            [
                'name' => 'report-product_type',
                'display_name' => '[Report] Generate Report Product Type',
                'description' => 'Generate Report Product Type'
            ],
            [
                'name' => 'report-bank',
                'display_name' => '[Report] Generate Report Bank',
                'description' => 'Generate Report Bank'
            ],
            [
                'name' => 'report-warehouse',
                'display_name' => '[Report] Generate Report Warehouse',
                'description' => 'Generate Report Warehouse'
            ],
            [
                'name' => 'report-truck',
                'display_name' => '[Report] Generate Report Truck',
                'description' => 'Generate Report Truck'
            ],
            [
                'name' => 'report-truck_maintenance',
                'display_name' => '[Report] Generate Report Truck Maintenance',
                'description' => 'Generate Report Truck Maintenance'
            ],
            [
                'name' => 'report-vendor_trucking',
                'display_name' => '[Report] Generate Report Vendor Trucking',
                'description' => 'Generate Report Vendor Trucking'
            ],
            [
                'name' => 'report-po',
                'display_name' => '[Report] Generate Report PO',
                'description' => 'Generate Report PO'
            ],
            [
                'name' => 'report-so',
                'display_name' => '[Report] Generate Report Sales',
                'description' => 'Generate Report Sales'
            ],
            [
                'name' => 'report-stock_history',
                'display_name' => '[Report] Generate Report Stock History',
                'description' => 'Generate Report Stock History'
            ],
        ];
        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }
}