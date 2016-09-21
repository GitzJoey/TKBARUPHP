<?php

/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 10:19 PM
 */

use \Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permission = [
            [
                'name' => 'admin.user-list',
                'display_name' => 'Display User Listing',
                'description' => 'See only Listing Of User'
            ],
            [
                'name' => 'admin.user-create',
                'display_name' => 'Create User',
                'description' => 'Create New User'
            ],
            [
                'name' => 'admin.user-edit',
                'display_name' => 'Edit User',
                'description' => 'Edit User'
            ],
            [
                'name' => 'admin.user-delete',
                'display_name' => 'Delete User',
                'description' => 'Delete User'
            ],
            [
                'name' => 'admin.role-list',
                'display_name' => 'Display Role Listing',
                'description' => 'See only Listing Of Role'
            ],
            [
                'name' => 'admin.role-create',
                'display_name' => 'Create Role',
                'description' => 'Create New Role'
            ],
            [
                'name' => 'admin.role-edit',
                'display_name' => 'Edit Role',
                'description' => 'Edit Role'
            ],
            [
                'name' => 'admin.role-delete',
                'display_name' => 'Delete Role',
                'description' => 'Delete Role'
            ],
            [
                'name' => 'admin.store-list',
                'display_name' => 'Display Store Listing',
                'description' => 'See only Listing Of Store'
            ],
            [
                'name' => 'admin.store-create',
                'display_name' => 'Create Store',
                'description' => 'Create New Store'
            ],
            [
                'name' => 'admin.store-edit',
                'display_name' => 'Edit Store',
                'description' => 'Edit Store'
            ],
            [
                'name' => 'admin.store-delete',
                'display_name' => 'Delete Store',
                'description' => 'Delete Store'
            ],
            [
                'name' => 'admin.unit-list',
                'display_name' => 'Display Unit Listing',
                'description' => 'See only Listing Of Unit'
            ],
            [
                'name' => 'admin.unit-create',
                'display_name' => 'Create Unit',
                'description' => 'Create New Unit'
            ],
            [
                'name' => 'admin.unit-edit',
                'display_name' => 'Edit Unit',
                'description' => 'Edit Unit'
            ],
            [
                'name' => 'admin.unit-delete',
                'display_name' => 'Delete Unit',
                'description' => 'Delete Unit'
            ],
            [
                'name' => 'admin.settings-list',
                'display_name' => 'Display Settings Listing',
                'description' => 'See only Listing Of Settings'
            ],
            [
                'name' => 'admin.settings-edit',
                'display_name' => 'Edit Settings',
                'description' => 'Edit Settings'
            ],
            [
                'name' => 'admin.phoneprovider-list',
                'display_name' => 'Display Phone Provider Listing',
                'description' => 'See only Listing Of Phone Provider'
            ],
            [
                'name' => 'admin.phoneprovider-create',
                'display_name' => 'Create Phone Provider',
                'description' => 'Create New Phone Provider'
            ],
            [
                'name' => 'admin.phoneprovider-edit',
                'display_name' => 'Edit Phone Provider',
                'description' => 'Edit Phone Provider'
            ],
            [
                'name' => 'admin.phoneprovider-delete',
                'display_name' => 'Delete Phone Provider',
                'description' => 'Delete Phone Provider'
            ],
            [
                'name' => 'admin.smsservice-list',
                'display_name' => 'List SMS',
                'description' => 'Show the inbox and outbox of SMS'
            ],
            [
                'name' => 'admin.smsservice-modem',
                'display_name' => 'Change Modem Settings',
                'description' => 'Change Modem Settings'
            ],
            [
                'name' => 'admin.smsservice-send',
                'display_name' => 'Send SMS',
                'description' => 'Enable Send SMS'
            ],
            [
                'name' => 'master.customer-list',
                'display_name' => 'Display Customer Listing',
                'description' => 'See only Listing Of Customer'
            ],
            [
                'name' => 'master.customer-create',
                'display_name' => 'Create Customer',
                'description' => 'Create New Customer'
            ],
            [
                'name' => 'master.customer-edit',
                'display_name' => 'Edit Customer',
                'description' => 'Edit Customer'
            ],
            [
                'name' => 'master.customer-delete',
                'display_name' => 'Delete Customer',
                'description' => 'Delete Customer'
            ],
            [
                'name' => 'master.supplier-list',
                'display_name' => 'Display Supplier Listing',
                'description' => 'See only Listing Of Supplier'
            ],
            [
                'name' => 'master.supplier-create',
                'display_name' => 'Create Supplier',
                'description' => 'Create New Supplier'
            ],
            [
                'name' => 'master.supplier-edit',
                'display_name' => 'Edit Supplier',
                'description' => 'Edit Supplier'
            ],
            [
                'name' => 'master.supplier-delete',
                'display_name' => 'Delete Supplier',
                'description' => 'Delete Supplier'
            ],
            [
                'name' => 'master.product-list',
                'display_name' => 'Display Product Listing',
                'description' => 'See only Listing Of Product'
            ],
            [
                'name' => 'master.product-create',
                'display_name' => 'Create Product',
                'description' => 'Create New Product'
            ],
            [
                'name' => 'master.product-edit',
                'display_name' => 'Edit Product',
                'description' => 'Edit Product'
            ],
            [
                'name' => 'master.product-delete',
                'display_name' => 'Delete Product',
                'description' => 'Delete Product'
            ],
            [
                'name' => 'master.product.producttype-list',
                'display_name' => 'Display Product Type Listing',
                'description' => 'See only Listing Of Product Type'
            ],
            [
                'name' => 'master.product.producttype-create',
                'display_name' => 'Create Product Type',
                'description' => 'Create New Product Type'
            ],
            [
                'name' => 'master.product.producttype-edit',
                'display_name' => 'Edit Product Type',
                'description' => 'Edit Product Type'
            ],
            [
                'name' => 'master.product.producttype-delete',
                'display_name' => 'Delete Product Type',
                'description' => 'Delete Product Type'
            ],
            [
                'name' => 'master.warehouse-list',
                'display_name' => 'Display Warehouse Listing',
                'description' => 'See only Listing Of Warehouse'
            ],
            [
                'name' => 'master.warehouse-create',
                'display_name' => 'Create Warehouse',
                'description' => 'Create New Warehouse'
            ],
            [
                'name' => 'master.warehouse-edit',
                'display_name' => 'Edit Warehouse',
                'description' => 'Edit Warehouse'
            ],
            [
                'name' => 'master.warehouse-delete',
                'display_name' => 'Delete Warehouse',
                'description' => 'Delete Warehouse'
            ],
            [
                'name' => 'master.bank-list',
                'display_name' => 'Display Bank Listing',
                'description' => 'See only Listing Of Bank'
            ],
            [
                'name' => 'master.bank-create',
                'display_name' => 'Create Bank',
                'description' => 'Create New Bank'
            ],
            [
                'name' => 'master.bank-edit',
                'display_name' => 'Edit Bank',
                'description' => 'Edit Bank'
            ],
            [
                'name' => 'master.bank-delete',
                'display_name' => 'Delete Bank',
                'description' => 'Delete Bank'
            ],
            [
                'name' => 'master.truck-list',
                'display_name' => 'Display Truck Listing',
                'description' => 'See only Listing Of Truck'
            ],
            [
                'name' => 'master.truck-create',
                'display_name' => 'Create Truck',
                'description' => 'Create New Truck'
            ],
            [
                'name' => 'master.truck-edit',
                'display_name' => 'Edit Truck',
                'description' => 'Edit Truck'
            ],
            [
                'name' => 'master.truck-delete',
                'display_name' => 'Delete Truck',
                'description' => 'Delete Truck'
            ],
            [
                'name' => 'master.vendor.truck-list',
                'display_name' => 'Display Vendor Truck Listing',
                'description' => 'See only Listing Of Vendor Truck'
            ],
            [
                'name' => 'master.vendor.truck-create',
                'display_name' => 'Create Vendor Truck',
                'description' => 'Create New Vendor Truck'
            ],
            [
                'name' => 'master.vendor.truck-edit',
                'display_name' => 'Edit Vendor Truck',
                'description' => 'Edit Vendor Truck'
            ],
            [
                'name' => 'master.vendor.truck-delete',
                'display_name' => 'Delete Vendor Truck',
                'description' => 'Delete Vendor Truck'
            ],
            [
                'name' => 'po.po-create',
                'display_name' => 'Create PO',
                'description' => 'Enable Create PO'
            ],
            [
                'name' => 'po.po-revise',
                'display_name' => 'Revise PO',
                'description' => 'Enable Revise PO'
            ],
            [
                'name' => 'po.po-payment',
                'display_name' => 'Payment PO',
                'description' => 'Enable Payment PO'
            ],
            [
                'name' => 'so.so-create',
                'display_name' => 'Create SO',
                'description' => 'Enable Create SO'
            ],
            [
                'name' => 'so.so-revise',
                'display_name' => 'Revise SO',
                'description' => 'Enable Revise SO'
            ],
            [
                'name' => 'so.so-payment',
                'display_name' => 'Payment SO',
                'description' => 'Enable Payment SO'
            ],
            [
                'name' => 'so.so-copy',
                'display_name' => 'SO Copy',
                'description' => 'Enable SO Copy'
            ],
            [
                'name' => 'price.todayprice-list',
                'display_name' => 'Display Today Price Listing',
                'description' => 'See only Listing Of Today Price'
            ],
            [
                'name' => 'price.todayprice-create',
                'display_name' => 'Create New Today Price',
                'description' => 'Create New Today Price'
            ],
            [
                'name' => 'price.pricelevel-list',
                'display_name' => 'Display Price Level Listing',
                'description' => 'See only Listing Of Price Level'
            ],
            [
                'name' => 'price.pricelevel-create',
                'display_name' => 'Create Price Level',
                'description' => 'Create New Price Level'
            ],
            [
                'name' => 'price.pricelevel-edit',
                'display_name' => 'Edit Price Level',
                'description' => 'Edit Price Level'
            ],
            [
                'name' => 'price.pricelevel-delete',
                'display_name' => 'Delete Price Level',
                'description' => 'Delete Price Level'
            ],
            [
                'name' => 'warehouse.inflow-input',
                'display_name' => 'Input Warehouse Inflow',
                'description' => 'Enable Input Warehouse Inflow'
            ],
            [
                'name' => 'warehouse.outflow-input',
                'display_name' => 'Input Warehouse Outflow',
                'description' => 'Enable Input Warehouse Outflow'
            ],
            [
                'name' => 'warehouse.stockopname',
                'display_name' => 'Input Stock Opname',
                'description' => 'Enable Input Stock Opname'
            ],
            [
                'name' => 'bank.upload',
                'display_name' => 'Upload Bank Data',
                'description' => 'Enable Upload Bank Data'
            ],
            [
                'name' => 'bank.consolidate',
                'display_name' => 'Consolidate Bank Data',
                'description' => 'Enable Consolidate Bank Data'
            ],
            [
                'name' => 'customer.confirmation',
                'display_name' => 'Customer Confirmation',
                'description' => 'Enable Customer Confirmation'
            ],
            [
                'name' => 'customer.approval',
                'display_name' => 'Customer Approval',
                'description' => 'Enable Customer Approval'
            ],
            [
                'name' => 'truck.maintenance-list',
                'display_name' => 'Display Truck Maintenance Listing',
                'description' => 'See only Listing Of Truck Maintenance'
            ],
            [
                'name' => 'truck.maintenance-create',
                'display_name' => 'Create Truck Maintenance',
                'description' => 'Create New Truck Maintenance'
            ],
            [
                'name' => 'truck.maintenance-edit',
                'display_name' => 'Edit Truck Maintenance',
                'description' => 'Edit Truck Maintenance'
            ],
            [
                'name' => 'truck.maintenance-delete',
                'display_name' => 'Delete Truck Maintenance',
                'description' => 'Delete Truck Maintenance'
            ],
        ];
        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }
}