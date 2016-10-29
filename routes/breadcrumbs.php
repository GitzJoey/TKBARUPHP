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

Breadcrumbs::register('inflow', function ($breadcrumbs){
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Inflow', route('db.warehouse.inflow.index'));
});

Breadcrumbs::register('receipt', function ($breadcrumbs, $poId){
    $breadcrumbs->parent('inflow');
    $breadcrumbs->push('Receipt', route('db.warehouse.inflow', $poId));
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
