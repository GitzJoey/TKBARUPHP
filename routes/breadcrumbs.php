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
