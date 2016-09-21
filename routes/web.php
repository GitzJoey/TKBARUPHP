<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Vinkla\Hashids\Facades\Hashids;

Route::get('/', function () {
    //return view('welcome');
    return redirect('home');
});

Auth::routes();

Route::group(['prefix' => LaravelLocalization::setLocale()], function ()
{
    Route::bind('id', function($id) {
        if (!is_numeric($id)) {
            return Hashids::decode($id)[0];
        } else {
            return $id;
        }
    });
    Route::get('/dashboard/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('db.logs');

    Route::get('/home', 'HomeController@index');

    Route::get('/dashboard', 'DashboardController@index');

    Route::get('/dashboard/po/create', 'PurchaseOrderController@create')->name('db.po.create');
    Route::post('/dashboard/po/create', 'PurchaseOrderController@store');

    Route::get('/dashboard/admin/user', 'UserController@index')->name('db.admin.user');
    Route::get('/dashboard/admin/user/show/{id}', 'UserController@show')->name('db.admin.user.show');
    Route::get('/dashboard/admin/user/create', 'UserController@create')->name('db.admin.user.create');
    Route::post('/dashboard/admin/user/create', 'UserController@store');
    Route::get('/dashboard/admin/user/edit/{id}', 'UserController@edit')->name('db.admin.user.edit');
    Route::patch('/dashboard/admin/user/edit/{id}', 'UserController@update');
    Route::delete('/dashboard/admin/user/edit/{id}', 'UserController@delete')->name('db.admin.user.delete');

    Route::get('/dashboard/user/profile/{id}', 'UserController@profile')->name('db.user.profile.show');

    Route::get('/dashboard/admin/roles', 'RolesController@index')->name('db.admin.roles');
    Route::get('/dashboard/admin/roles/show/{id}', 'RolesController@show')->name('db.admin.role.show');;
    Route::get('/dashboard/admin/roles/create', 'RolesController@create')->name('db.admin.role.create');
    Route::post('/dashboard/admin/roles/create', 'RolesController@store');
    Route::get('/dashboard/admin/roles/edit/{id}', 'RolesController@edit')->name('db.admin.role.edit');
    Route::patch('/dashboard/admin/roles/edit/{id}', 'RolesController@update');
    Route::delete('/dashboard/admin/roles/edit/{id}', 'RolesController@delete')->name('db.admin.role.delete');

    Route::get('/dashboard/admin/store', 'StoreController@index')->name('db.admin.store');
    Route::get('/dashboard/admin/store/show/{id}', 'StoreController@show')->name('db.admin.store.show');
    Route::get('/dashboard/admin/store/create', 'StoreController@create')->name('db.admin.store.create');
    Route::post('/dashboard/admin/store/create', 'StoreController@store');
    Route::get('/dashboard/admin/store/edit/{id}', 'StoreController@edit')->name('db.admin.store.edit');
    Route::patch('/dashboard/admin/store/edit/{id}', 'StoreController@update');
    Route::delete('/dashboard/admin/store/edit/{id}', 'StoreController@delete')->name('db.admin.store.delete');

    Route::get('/dashboard/admin/unit', 'UnitController@index')->name('db.admin.unit');
    Route::get('/dashboard/admin/unit/show/{id}', 'UnitController@show')->name('db.admin.unit.show');
    Route::get('/dashboard/admin/unit/create', 'UnitController@create')->name('db.admin.unit.create');
    Route::post('/dashboard/admin/unit/create', 'UnitController@store');
    Route::get('/dashboard/admin/unit/edit/{id}', 'UnitController@edit')->name('db.admin.unit.edit');
    Route::patch('/dashboard/admin/unit/edit/{id}', 'UnitController@update');
    Route::delete('/dashboard/admin/unit/edit/{id}', 'UnitController@delete')->name('db.admin.unit.delete');

    Route::get('/dashboard/admin/phoneProvider', 'PhoneProviderController@index')->name('db.admin.phoneProvider');
    Route::get('/dashboard/admin/phoneProvider/show/{id}', 'PhoneProviderController@show')->name('db.admin.phoneProvider.show');
    Route::get('/dashboard/admin/phoneProvider/create', 'PhoneProviderController@create')->name('db.admin.phoneProvider.create');
    Route::post('/dashboard/admin/phoneProvider/create', 'PhoneProviderController@store');
    Route::get('/dashboard/admin/phoneProvider/edit/{id}', 'PhoneProviderController@edit')->name('db.admin.phoneProvider.edit');
    Route::patch('/dashboard/admin/phoneProvider/edit/{id}', 'PhoneProviderController@update');
    Route::delete('/dashboard/admin/phoneProvider/edit/{id}', 'PhoneProviderController@delete')->name('db.admin.phoneProvider.delete');

    Route::get('/dashboard/admin/settings', 'SettingsController@index')->name('db.admin.settings');
    Route::get('/dashboard/admin/settings/edit/{id}', 'SettingsController@edit');
    Route::patch('/dashboard/admin/settings/edit/{id}', 'SettingsController@update');

    Route::get('/dashboard/master/customer', 'CustomerController@index')->name('db.master.customer');
    Route::get('/dashboard/master/customer/show/{id}', 'CustomerController@show');
    Route::get('/dashboard/master/customer/create', 'CustomerController@create');
    Route::post('/dashboard/master/customer/create', 'CustomerController@store');
    Route::get('/dashboard/master/customer/edit/{id}', 'CustomerController@edit');
    Route::patch('/dashboard/master/customer/edit/{id}', 'CustomerController@update');
    Route::delete('/dashboard/master/customer/edit/{id}', 'CustomerController@delete');

    Route::get('/dashboard/master/supplier', 'SupplierController@index')->name('db.master.supplier');
    Route::get('/dashboard/master/supplier/show/{id}', 'SupplierController@show');
    Route::get('/dashboard/master/supplier/create', 'SupplierController@create');
    Route::post('/dashboard/master/supplier/create', 'SupplierController@store');
    Route::get('/dashboard/master/supplier/edit/{id}', 'SupplierController@edit');
    Route::patch('/dashboard/master/supplier/edit/{id}', 'SupplierController@update');
    Route::delete('/dashboard/master/supplier/edit/{id}', 'SupplierController@delete');

    Route::get('/dashboard/master/product', 'ProductController@index')->name('db.master.product');
    Route::get('/dashboard/master/product/show/{id}', 'ProductController@show')->name('db.master.product.show');
    Route::get('/dashboard/master/product/create', 'ProductController@create')->name('db.master.product.create');
    Route::post('/dashboard/master/product/create', 'ProductController@store');
    Route::get('/dashboard/master/product/edit/{id}', 'ProductController@edit')->name('db.master.product.edit');
    Route::patch('/dashboard/master/product/edit/{id}', 'ProductController@update');
    Route::delete('/dashboard/master/product/edit/{id}', 'ProductController@delete')->name('db.master.product.delete');

    Route::get('/dashboard/master/warehouse', 'WarehouseController@index')->name('db.master.warehouse');
    Route::get('/dashboard/master/warehouse/show/{id}', 'WarehouseController@show');
    Route::get('/dashboard/master/warehouse/create', 'WarehouseController@create');
    Route::post('/dashboard/master/warehouse/create', 'WarehouseController@store');
    Route::get('/dashboard/master/warehouse/edit/{id}', 'WarehouseController@edit');
    Route::patch('/dashboard/master/warehouse/edit/{id}', 'WarehouseController@update');
    Route::delete('/dashboard/master/warehouse/edit/{id}', 'WarehouseController@delete');

    Route::get('/dashboard/master/bank', 'BankController@index')->name('db.master.bank');
    Route::get('/dashboard/master/bank/show/{id}', 'BankController@show')->name('db.master.bank.show');;
    Route::get('/dashboard/master/bank/create', 'BankController@create')->name('db.master.bank.create');;
    Route::post('/dashboard/master/bank/create', 'BankController@store');
    Route::get('/dashboard/master/bank/edit/{id}', 'BankController@edit')->name('db.master.bank.edit');;
    Route::patch('/dashboard/master/bank/edit/{id}', 'BankController@update');
    Route::delete('/dashboard/master/bank/edit/{id}', 'BankController@delete')->name('db.master.bank.delete');;

    Route::get('/dashboard/master/truck', 'TruckController@index')->name('db.master.truck');
    Route::get('/dashboard/master/truck/show/{id}', 'TruckController@show')->name('db.master.truck.show');
    Route::get('/dashboard/master/truck/create', 'TruckController@create')->name('db.master.truck.create');
    Route::post('/dashboard/master/truck/create/', 'TruckController@store');
    Route::get('/dashboard/master/truck/edit/{id}', 'TruckController@edit')->name('db.master.truck.edit');
    Route::patch('/dashboard/master/truck/edit/{id}', 'TruckController@update');
    Route::delete('/dashboard/master/truck/edit/{id}', 'TruckController@delete')->name('db.master.truck.delete');

    Route::get('/dashboard/master/truck/maintenance', 'TruckMaintenanceController@index')->name('db.master.truck.maintenance');
    Route::get('/dashboard/master/truck/maintenance/show/{id}', 'TruckMaintenanceController@show');
    Route::get('/dashboard/master/truck/maintenance/create', 'TruckMaintenanceController@create');
    Route::post('/dashboard/master/truck/maintenance/create', 'TruckMaintenanceController@store');
    Route::get('/dashboard/master/truck/maintenance/edit/{id}', 'TruckMaintenanceController@edit');
    Route::patch('/dashboard/master/truck/maintenance/edit/{id}', 'TruckMaintenanceController@update');
    Route::delete('/dashboard/master/truck/maintenance/edit/{id}', 'TruckMaintenanceController@delete');

    Route::get('/dashboard/master/vendor/trucking', 'VendorTruckingController@index')->name('db.master.vendor.trucking');
    Route::get('/dashboard/master/vendor/trucking/show/{id}', 'VendorTruckingController@show');
    Route::get('/dashboard/master/vendor/trucking/create', 'VendorTruckingController@create');
    Route::post('/dashboard/master/vendor/trucking/create', 'VendorTruckingController@store');
    Route::get('/dashboard/master/vendor/trucking/edit/{id}', 'VendorTruckingController@edit');
    Route::patch('/dashboard/master/vendor/trucking/edit/{id}', 'VendorTruckingController@update');
    Route::delete('/dashboard/master/vendor/trucking/edit/{id}', 'VendorTruckingController@delete');

    Route::get('/dashboard/customer/confirmation', 'CustomerController@confirmation')->name('db.customer.confirmation');
    Route::get('/dashboard/customer/confirmation/{id}', 'CustomerController@confirmation');
    Route::patch('/dashboard/customer/confirmation/{id}', 'CustomerController@confirmation');

    Route::get('/dashboard/customer/approval', 'CustomerController@approval')->name('db.customer.approval');
    Route::get('/dashboard/customer/approval/{id}', 'CustomerController@approval');
    Route::patch('/dashboard/customer/approval/{id}', 'CustomerController@approval');

    Route::get('/dashboard/warehouse/inflow', 'WarehouseController@inflow')->name('db.warehouse.inflow');
    Route::get('/dashboard/warehouse/outflow', 'WarehouseController@inflow')->name('db.warehouse.outflow');
    Route::get('/dashboard/warehouse/stockopname', 'WarehouseController@stockopname')->name('db.warehouse.stockopname');
});

