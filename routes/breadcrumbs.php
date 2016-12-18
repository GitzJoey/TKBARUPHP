<?php
/**
 * Created by PhpStorm.
 * User: miftah.fathudin
 * Date: 10/29/2016
 * Time: 10:50 AM
 */

Breadcrumbs::register('dashboard', function ($breadcrumbs){
    $breadcrumbs->push('Dashboard', route('db'));
});

Breadcrumbs::register('create_purchase_order', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Create Purchase Order', route('db.po.create'));
});

Breadcrumbs::register('purchase_order', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Purchase Order', route('db.po.revise.index'));
});

Breadcrumbs::register('revise_purchase_order', function ($breadcrumbs, $poId){
    $breadcrumbs->parent('purchase_order');
    $breadcrumbs->push('Revise Purchase Order', route('db.po.revise', $poId));
});

Breadcrumbs::register('purchase_order_payment', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Purchase Order Payment', route('db.po.payment.index'));
});

Breadcrumbs::register('purchase_order_payment_cash', function ($breadcrumbs, $poId){
    $breadcrumbs->parent('purchase_order_payment');
    $breadcrumbs->push('Cash Payment', route('db.po.payment.cash', $poId));
});

Breadcrumbs::register('purchase_order_payment_transfer', function ($breadcrumbs, $poId){
    $breadcrumbs->parent('purchase_order_payment');
    $breadcrumbs->push('Transfer Payment', route('db.po.payment.transfer', $poId));
});

Breadcrumbs::register('purchase_order_payment_giro', function ($breadcrumbs, $poId){
    $breadcrumbs->parent('purchase_order_payment');
    $breadcrumbs->push('Giro Payment', route('db.po.payment.giro', $poId));
});

Breadcrumbs::register('inflow', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Inflow', route('db.warehouse.inflow.index'));
});

Breadcrumbs::register('receipt', function ($breadcrumbs, $poId){
    $breadcrumbs->parent('inflow');
    $breadcrumbs->push('Receipt', route('db.warehouse.inflow', $poId));
});

Breadcrumbs::register('outflow', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Outflow', route('db.warehouse.outflow.index'));
});

Breadcrumbs::register('deliver', function ($breadcrumbs, $soId){
    $breadcrumbs->parent('outflow');
    $breadcrumbs->push('Deliver', route('db.warehouse.outflow', $soId));
});

Breadcrumbs::register('create_sales_order', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Create Sales Order', route('db.so.create'));
});

Breadcrumbs::register('sales_order', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Sales Order', route('db.so.revise.index'));
});

Breadcrumbs::register('revise_sales_order', function ($breadcrumbs, $soId){
    $breadcrumbs->parent('sales_order');
    $breadcrumbs->push('Revise Sales Order', route('db.so.revise', $soId));
});

Breadcrumbs::register('sales_order_payment', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Sales Order Payment', route('db.so.payment.index'));
});

Breadcrumbs::register('sales_order_payment_cash', function ($breadcrumbs, $soId){
    $breadcrumbs->parent('sales_order_payment');
    $breadcrumbs->push('Cash Payment', route('db.so.payment.cash', $soId));
});

Breadcrumbs::register('sales_order_payment_transfer', function ($breadcrumbs, $soId){
    $breadcrumbs->parent('sales_order_payment');
    $breadcrumbs->push('Transfer Payment', route('db.so.payment.transfer', $soId));
});

Breadcrumbs::register('sales_order_payment_giro', function ($breadcrumbs, $soId){
    $breadcrumbs->parent('sales_order_payment');
    $breadcrumbs->push('Giro Payment', route('db.so.payment.giro', $soId));
});

Breadcrumbs::register('admin_user', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('User', route('db.admin.user'));
});

Breadcrumbs::register('admin_user_create', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('User', route('db.admin.user'));
    $breadcrumbs->push('Create User', route('db.admin.user.create'));
});

Breadcrumbs::register('admin_user_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('User', route('db.admin.user'));
    $breadcrumbs->push('Show User', route('db.admin.user.show', $id));
});

Breadcrumbs::register('admin_user_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('User', route('db.admin.user'));
    $breadcrumbs->push('Edit User', route('db.admin.user.edit', $id));
});

Breadcrumbs::register('admin_role', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Role', route('db.admin.roles'));
});

Breadcrumbs::register('admin_role_create', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Role', route('db.admin.roles'));
    $breadcrumbs->push('Create Role', route('db.admin.roles.create'));
});

Breadcrumbs::register('admin_role_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Role', route('db.admin.roles'));
    $breadcrumbs->push('Show Role', route('db.admin.roles.show', $id));
});

Breadcrumbs::register('admin_role_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Role', route('db.admin.roles'));
    $breadcrumbs->push('Edit Role', route('db.admin.roles.edit', $id));
});

Breadcrumbs::register('admin_store', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Store', route('db.admin.store'));
});

Breadcrumbs::register('admin_store_create', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Store', route('db.admin.store'));
    $breadcrumbs->push('Create Store', route('db.admin.store.create'));
});

Breadcrumbs::register('admin_store_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Store', route('db.admin.store'));
    $breadcrumbs->push('Show Store', route('db.admin.store.show', $id));
});

Breadcrumbs::register('admin_store_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Store', route('db.admin.store'));
    $breadcrumbs->push('Edit Store', route('db.admin.store.edit', $id));
});

Breadcrumbs::register('admin_unit', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Unit', route('db.admin.unit'));
});

Breadcrumbs::register('admin_unit_create', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Unit', route('db.admin.unit'));
    $breadcrumbs->push('Create Unit', route('db.admin.unit.create'));
});

Breadcrumbs::register('admin_unit_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Unit', route('db.admin.unit'));
    $breadcrumbs->push('Show Unit', route('db.admin.unit.show', $id));
});

Breadcrumbs::register('admin_unit_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Unit', route('db.admin.unit'));
    $breadcrumbs->push('Edit Unit', route('db.admin.unit.edit', $id));
});

Breadcrumbs::register('admin_phone_provider', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Phone Provider', route('db.admin.phone_provider'));
});

Breadcrumbs::register('admin_phone_provider_create', function($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Phone Provider', route('db.admin.phone_provider'));
    $breadcrumbs->push('Create Phone Provider', route('db.admin.phone_provider.create'));
});

Breadcrumbs::register('admin_phone_provider_show', function($breadcrumbs, $id){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Phone Provider', route('db.admin.phone_provider'));
    $breadcrumbs->push('Show Phone Provider', route('db.admin.phone_provider.show', $id));
});

Breadcrumbs::register('admin_phone_provider_edit', function($breadcrumbs, $id){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Phone Provider', route('db.admin.phone_provider'));
    $breadcrumbs->push('Edit Phone Provider', route('db.admin.phone_provider.edit', $id));
});
