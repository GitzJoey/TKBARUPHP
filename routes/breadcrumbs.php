<?php
/**
 * Created by PhpStorm.
 * User: miftah.fathudin
 * Date: 10/29/2016
 * Time: 10:50 AM
 */

Breadcrumbs::register('dashboard', function ($breadcrumbs){
    $breadcrumbs->push(trans('breadcrumb.dashboard'), route('db'));
});

Breadcrumbs::register('create_purchase_order', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.po.create'), route('db.po.create'));
});

Breadcrumbs::register('purchase_order', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.po.list'), route('db.po.revise.index'));
});

Breadcrumbs::register('revise_purchase_order', function ($breadcrumbs, $poId){
    $breadcrumbs->parent('purchase_order');
    $breadcrumbs->push(trans('breadcrumb.po.revise'), route('db.po.revise', $poId));
});

Breadcrumbs::register('revise_purchase_order_detail', function ($breadcrumbs, $currentPo){
    $breadcrumbs->parent('purchase_order');
    $breadcrumbs->push($currentPo->code, route('db.po.revise', $currentPo->hId()));
});

Breadcrumbs::register('purchase_order_payment', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.po.payment.list'), route('db.po.payment.index'));
});

Breadcrumbs::register('purchase_order_payment_cash', function ($breadcrumbs, $poId){
    $breadcrumbs->parent('purchase_order_payment');
    $breadcrumbs->push(trans('breadcrumb.po.payment.cash'), route('db.po.payment.cash', $poId));
});

Breadcrumbs::register('purchase_order_payment_transfer', function ($breadcrumbs, $poId){
    $breadcrumbs->parent('purchase_order_payment');
    $breadcrumbs->push(trans('breadcrumb.po.payment.transfer'), route('db.po.payment.transfer', $poId));
});

Breadcrumbs::register('purchase_order_payment_giro', function ($breadcrumbs, $poId){
    $breadcrumbs->parent('purchase_order_payment');
    $breadcrumbs->push(trans('breadcrumb.po.payment.giro'), route('db.po.payment.giro', $poId));
});

Breadcrumbs::register('purchase_order_copy', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.po.copy'), route('db.po.copy'));
});

Breadcrumbs::register('inflow', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.warehouse.inflow.index'), route('db.warehouse.inflow.index'));
});

Breadcrumbs::register('receipt', function ($breadcrumbs, $poId){
    $breadcrumbs->parent('inflow');
    $breadcrumbs->push(trans('breadcrumb.warehouse.inflow.receipt'), route('db.warehouse.inflow', $poId));
});

Breadcrumbs::register('outflow', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.warehouse.outflow.index'), route('db.warehouse.outflow.index'));
});

Breadcrumbs::register('deliver', function ($breadcrumbs, $soId){
    $breadcrumbs->parent('outflow');
    $breadcrumbs->push(trans('breadcrumb.warehouse.outflow.deliver'), route('db.warehouse.outflow', $soId));
});

Breadcrumbs::register('create_sales_order', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.so.create'), route('db.so.create'));
});

Breadcrumbs::register('sales_order', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.so.list'), route('db.so.revise.index'));
});

Breadcrumbs::register('revise_sales_order', function ($breadcrumbs, $soId){
    $breadcrumbs->parent('sales_order');
    $breadcrumbs->push(trans('breadcrumb.so.revise'), route('db.so.revise', $soId));
});

Breadcrumbs::register('revise_sales_order_detail', function ($breadcrumbs, $currentSO){
    $breadcrumbs->parent('sales_order');
    $breadcrumbs->push($currentSO->code, route('db.so.revise', $currentSO->hId()));
});

Breadcrumbs::register('sales_order_payment', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.so.payment.list'), route('db.so.payment.index'));
});

Breadcrumbs::register('sales_order_payment_cash', function ($breadcrumbs, $soId){
    $breadcrumbs->parent('sales_order_payment');
    $breadcrumbs->push(trans('breadcrumb.so.payment.cash'), route('db.so.payment.cash', $soId));
});

Breadcrumbs::register('sales_order_payment_transfer', function ($breadcrumbs, $soId){
    $breadcrumbs->parent('sales_order_payment');
    $breadcrumbs->push(trans('breadcrumb.so.payment.transfer'), route('db.so.payment.transfer', $soId));
});

Breadcrumbs::register('sales_order_payment_giro', function ($breadcrumbs, $soId){
    $breadcrumbs->parent('sales_order_payment');
    $breadcrumbs->push(trans('breadcrumb.so.payment.giro'), route('db.so.payment.giro', $soId));
});

Breadcrumbs::register('sales_order_copy', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.so.copy'), route('db.so.copy'));
});

Breadcrumbs::register('admin_user', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.admin.user'), route('db.admin.user'));
});

Breadcrumbs::register('admin_user_create', function($breadcrumbs){
    $breadcrumbs->parent('admin_user');
    $breadcrumbs->push(trans('breadcrumb.admin.user.create'), route('db.admin.user.create'));
});

Breadcrumbs::register('admin_user_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('admin_user');
    $breadcrumbs->push(trans('breadcrumb.admin.user.show'), route('db.admin.user.show', $id));
});

Breadcrumbs::register('admin_user_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('admin_user');
    $breadcrumbs->push(trans('breadcrumb.admin.user.edit'), route('db.admin.user.edit', $id));
});

Breadcrumbs::register('admin_role', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.admin.role'), route('db.admin.roles'));
});

Breadcrumbs::register('admin_role_create', function($breadcrumbs){
    $breadcrumbs->parent('admin_role');
    $breadcrumbs->push(trans('breadcrumb.admin.role.create'), route('db.admin.roles.create'));
});

Breadcrumbs::register('admin_role_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('admin_role');
    $breadcrumbs->push(trans('breadcrumb.admin.role.show'), route('db.admin.roles.show', $id));
});

Breadcrumbs::register('admin_role_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('admin_role');
    $breadcrumbs->push(trans('breadcrumb.admin.role.edit'), route('db.admin.roles.edit', $id));
});

Breadcrumbs::register('admin_store', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.admin.store'), route('db.admin.store'));
});

Breadcrumbs::register('admin_store_create', function($breadcrumbs){
    $breadcrumbs->parent('admin_store');
    $breadcrumbs->push(trans('breadcrumb.admin.store.create'), route('db.admin.store.create'));
});

Breadcrumbs::register('admin_store_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('admin_store');
    $breadcrumbs->push(trans('breadcrumb.admin.store.show'), route('db.admin.store.show', $id));
});

Breadcrumbs::register('admin_store_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('admin_store');
    $breadcrumbs->push(trans('breadcrumb.admin.store.edit'), route('db.admin.store.edit', $id));
});

Breadcrumbs::register('admin_unit', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.admin.unit'), route('db.admin.unit'));
});

Breadcrumbs::register('admin_unit_create', function($breadcrumbs){
    $breadcrumbs->parent('admin_unit');
    $breadcrumbs->push(trans('breadcrumb.admin.unit.create'), route('db.admin.unit.create'));
});

Breadcrumbs::register('admin_unit_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('admin_unit');
    $breadcrumbs->push(trans('breadcrumb.admin.unit.show'), route('db.admin.unit.show', $id));
});

Breadcrumbs::register('admin_unit_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('admin_unit');
    $breadcrumbs->push(trans('breadcrumb.admin.unit.edit'), route('db.admin.unit.edit', $id));
});

Breadcrumbs::register('admin_phone_provider', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.admin.phone_provider'), route('db.admin.phone_provider'));
});

Breadcrumbs::register('admin_phone_provider_create', function($breadcrumbs){
    $breadcrumbs->parent('admin_phone_provider');
    $breadcrumbs->push(trans('breadcrumb.admin.phone_provider.create'), route('db.admin.phone_provider.create'));
});

Breadcrumbs::register('admin_phone_provider_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('admin_phone_provider');
    $breadcrumbs->push(trans('breadcrumb.phone_provider.show'), route('db.admin.phone_provider.show', $id));
});

Breadcrumbs::register('admin_phone_provider_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('admin_phone_provider');
    $breadcrumbs->push(trans('breadcrumb.admin.phone_provider.edit'), route('db.admin.phone_provider.edit', $id));
});

Breadcrumbs::register('master_customer', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.master.customer'), route('db.master.customer'));
});

Breadcrumbs::register('master_customer_create', function($breadcrumbs){
    $breadcrumbs->parent('master_customer');
    $breadcrumbs->push(trans('breadcrumb.master.customer.create'), route('db.master.customer.create'));
});

Breadcrumbs::register('master_customer_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_customer');
    $breadcrumbs->push(trans('breadcrumb.master.customer.show'), route('db.master.customer.show', $id));
});

Breadcrumbs::register('master_customer_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_customer');
    $breadcrumbs->push(trans('breadcrumb.master.customer.edit'), route('db.master.customer.edit', $id));
});

Breadcrumbs::register('master_supplier', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.master.supplier'), route('db.master.supplier'));
});

Breadcrumbs::register('master_supplier_create', function($breadcrumbs){
    $breadcrumbs->parent('master_supplier');
    $breadcrumbs->push(trans('breadcrumb.master.supplier.create'), route('db.master.supplier.create'));
});

Breadcrumbs::register('master_supplier_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_supplier');
    $breadcrumbs->push(trans('breadcrumb.master.supplier.show'), route('db.master.supplier.show', $id));
});

Breadcrumbs::register('master_supplier_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_supplier');
    $breadcrumbs->push(trans('breadcrumb.master.supplier.edit'), route('db.master.supplier.edit', $id));
});

Breadcrumbs::register('master_product', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.master.product'), route('db.master.product'));
});

Breadcrumbs::register('master_product_create', function($breadcrumbs){
    $breadcrumbs->parent('master_product');
    $breadcrumbs->push(trans('breadcrumb.master.product.create'), route('db.master.product.create'));
});

Breadcrumbs::register('master_product_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_product');
    $breadcrumbs->push(trans('breadcrumb.master.product.show'), route('db.master.product.show', $id));
});

Breadcrumbs::register('master_product_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_product');
    $breadcrumbs->push(trans('breadcrumb.master.product.edit'), route('db.master.product.edit', $id));
});

Breadcrumbs::register('master_product_type', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.master.product_type'), route('db.master.producttype'));
});

Breadcrumbs::register('master_product_type_create', function($breadcrumbs){
    $breadcrumbs->parent('master_product_type');
    $breadcrumbs->push(trans('breadcrumb.master.product_type.create'), route('db.master.producttype.create'));
});

Breadcrumbs::register('master_product_type_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_product_type');
    $breadcrumbs->push(trans('breadcrumb.master.product_type.show'), route('db.master.producttype.show', $id));
});

Breadcrumbs::register('master_product_type_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_product_type');
    $breadcrumbs->push(trans('breadcrumb.master.product_type.edit'), route('db.master.producttype.edit', $id));
});

Breadcrumbs::register('master_warehouse', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Warehouse', route('db.master.warehouse'));
});

Breadcrumbs::register('master_warehouse_create', function($breadcrumbs){
    $breadcrumbs->parent('master_warehouse');
    $breadcrumbs->push(trans('breadcrumb.master.warehouse.create'), route('db.master.warehouse.create'));
});

Breadcrumbs::register('master_warehouse_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_warehouse');
    $breadcrumbs->push(trans('breadcrumb.master.warehouse.show'), route('db.master.warehouse.show', $id));
});

Breadcrumbs::register('master_warehouse_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_warehouse');
    $breadcrumbs->push(trans('breadcrumb.master.warehouse.edit'), route('db.master.warehouse.edit', $id));
});

Breadcrumbs::register('master_bank', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.master.bank'), route('db.master.bank'));
});

Breadcrumbs::register('master_bank_create', function($breadcrumbs){
    $breadcrumbs->parent('master_bank');
    $breadcrumbs->push(trans('breadcrumb.master.bank.create'), route('db.master.bank.create'));
});

Breadcrumbs::register('master_bank_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_bank');
    $breadcrumbs->push(trans('breadcrumb.master.bank.show'), route('db.master.bank.show', $id));
});

Breadcrumbs::register('master_bank_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_bank');
    $breadcrumbs->push(trans('breadcrumb.master.bank.edit'), route('db.master.bank.edit', $id));
});

Breadcrumbs::register('master_truck', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.master.truck'), route('db.master.truck'));
});

Breadcrumbs::register('master_truck_create', function($breadcrumbs){
    $breadcrumbs->parent('master_truck');
    $breadcrumbs->push(trans('breadcrumb.master.truck.create'), route('db.master.truck.create'));
});

Breadcrumbs::register('master_truck_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_truck');
    $breadcrumbs->push(trans('breadcrumb.master.truck.show'), route('db.master.truck.show', $id));
});

Breadcrumbs::register('master_truck_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_truck');
    $breadcrumbs->push(trans('breadcrumb.master.truck.edit'), route('db.master.truck.edit', $id));
});

Breadcrumbs::register('master_vendor_trucking', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.master.vendor_trucking'), route('db.master.vendor.trucking'));
});

Breadcrumbs::register('master_vendor_trucking_create', function($breadcrumbs){
    $breadcrumbs->parent('master_vendor_trucking');
    $breadcrumbs->push(trans('breadcrumb.master.vendor_trucking.create'), route('db.master.vendor.trucking.create'));
});

Breadcrumbs::register('master_vendor_trucking_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_vendor_trucking');
    $breadcrumbs->push(trans('breadcrumb.master.vendor_trucking.show'), route('db.master.vendor.trucking.show', $id));
});

Breadcrumbs::register('master_vendor_trucking_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('master_vendor_trucking');
    $breadcrumbs->push(trans('breadcrumb.master.vendor_trucking.edit'), route('db.master.vendor.trucking.edit', $id));
});

Breadcrumbs::register('truck_maintenance', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.truck_maintenance'), route('db.truck.maintenance'));
});

Breadcrumbs::register('truck_maintenance_create', function($breadcrumbs){
    $breadcrumbs->parent('truck_maintenance');
    $breadcrumbs->push(trans('breadcrumb.truck_maintenance.create'), route('db.truck.maintenance.create'));
});

Breadcrumbs::register('truck_maintenance_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('truck_maintenance');
    $breadcrumbs->push(trans('breadcrumb.truck_maintenance.edit'), route('db.truck.maintenance.edit', $id));
});

Breadcrumbs::register('customer_confirmation', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.customer.confirmation'), route('db.customer.confirmation.index'));
});

Breadcrumbs::register('customer_confirmation_confirm', function($breadcrumbs, $id){
    $breadcrumbs->parent('customer_confirmation');
    $breadcrumbs->push(trans('breadcrumb.customer.confirmation.confirm'), route('db.customer.confirmation.confirm', $id));
});

Breadcrumbs::register('user_profile', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.user.profile'), route('db.user.profile.show', $id));
});

Breadcrumbs::register('user_calendar', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('breadcrumb.user.calendar'), route('db.user.calendar.show'));
});
