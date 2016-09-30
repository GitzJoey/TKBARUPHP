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
    Route::get('/dashboard/admin/roles/show/{id}', 'RolesController@show')->name('db.admin.roles.show');;
    Route::get('/dashboard/admin/roles/create', 'RolesController@create')->name('db.admin.roles.create');
    Route::post('/dashboard/admin/roles/create', 'RolesController@store');
    Route::get('/dashboard/admin/roles/edit/{id}', 'RolesController@edit')->name('db.admin.roles.edit');
    Route::patch('/dashboard/admin/roles/edit/{id}', 'RolesController@update');
    Route::delete('/dashboard/admin/roles/edit/{id}', 'RolesController@delete')->name('db.admin.roles.delete');

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
    Route::get('/dashboard/admin/settings/edit/{id}', 'SettingsController@edit')->name('db.admin.settings.edit');
    Route::patch('/dashboard/admin/settings/edit/{id}', 'SettingsController@update');

    Route::get('/dashboard/master/customer', 'CustomerController@index')->name('db.master.customer');
    Route::get('/dashboard/master/customer/show/{id}', 'CustomerController@show');
    Route::get('/dashboard/master/customer/create', 'CustomerController@create');
    Route::post('/dashboard/master/customer/create', 'CustomerController@store');
    Route::get('/dashboard/master/customer/edit/{id}', 'CustomerController@edit');
    Route::patch('/dashboard/master/customer/edit/{id}', 'CustomerController@update');
    Route::delete('/dashboard/master/customer/edit/{id}', 'CustomerController@delete');

    Route::get('/dashboard/master/supplier', 'SupplierController@index')->name('db.master.supplier');
    Route::get('/dashboard/master/supplier/show/{id}', 'SupplierController@show')->name('db.master.supplier.show');
    Route::get('/dashboard/master/supplier/create', 'SupplierController@create')->name('db.master.supplier.create');
    Route::post('/dashboard/master/supplier/create', 'SupplierController@store')->name('db.master.supplier.store');
    Route::get('/dashboard/master/supplier/edit/{id}', 'SupplierController@edit')->name('db.master.supplier.edit');
    Route::patch('/dashboard/master/supplier/edit/{id}', 'SupplierController@update')->name('db.master.supplier.update');
    Route::delete('/dashboard/master/supplier/edit/{id}', 'SupplierController@delete')->name('db.master.supplier.delete');
    Route::post('/dashboard/master/supplier/{id}/add/pic', 'SupplierController@storePic')->name('db.master.supplier.pic.store');
    Route::get('/dashboard/master/supplier/{id}/pic/edit/{pic_id}', 'SupplierController@editPic')->name('db.master.supplier.pic.edit');
    Route::patch('/dashboard/master/supplier/{id}/pic/{pic_id}', 'SupplierController@updatePic')->name('db.master.supplier.pic.update');
    Route::delete('/dashboard/master/supplier/{id}/pic/{pic_id}', 'SupplierController@deletePic')->name('db.master.supplier.pic.delete');
    Route::get('/dashboard/master/supplier/{id}/pic/{pic_id}/phone/', 'SupplierController@createPhone')->name('db.master.supplier.pic.phone.create');
    Route::post('/dashboard/master/supplier/{id}/pic/{pic_id}/phone/', 'SupplierController@storePhone')->name('db.master.supplier.pic.phone.store');
    Route::get('/dashboard/master/supplier/{id}/pic/{pic_id}/phone/edit/{phone_id}', 'SupplierController@editPhone')->name('db.master.supplier.pic.phone.edit');
    Route::patch('/dashboard/master/supplier/{id}/pic/{pic_id}/phone/{phone_id}', 'SupplierController@updatePhone')->name('db.master.supplier.pic.phone.update');
    Route::delete('/dashboard/master/supplier/{id}/pic/{pic_id}/phone/{phone_id}', 'SupplierController@deletePhone')->name('db.master.supplier.pic.phone.delete');
    Route::post('/dashboard/master/supplier/bank', 'SupplierController@addBank')->name('db.master.supplier.bank.store');
    Route::get('/dashboard/master/supplier/{id}/bank/edit/{bank_id}', 'SupplierController@editBank')->name('db.master.supplier.bank.edit');
    Route::patch('/dashboard/master/supplier/{id}/bank/edit/{bank_id}', 'SupplierController@updateBank')->name('db.master.supplier.bank.update');
    Route::delete('/dashboard/master/supplier/{id}/bank/{bank_id}', 'SupplierController@deleteBank')->name('db.master.supplier.bank.delete');
    Route::post('/dashboard/master/supplier/{id}/setting', 'SupplierController@addSetting')->name('db.master.supplier.setting.store');

    Route::get('/dashboard/master/product', 'ProductController@index')->name('db.master.product');
    Route::get('/dashboard/master/product/show/{id}', 'ProductController@show')->name('db.master.product.show');
    Route::get('/dashboard/master/product/create', 'ProductController@create')->name('db.master.product.create');
    Route::post('/dashboard/master/product/create', 'ProductController@store');
    Route::get('/dashboard/master/product/edit/{id}', 'ProductController@edit')->name('db.master.product.edit');
    Route::patch('/dashboard/master/product/edit/{id}', 'ProductController@update');
    Route::delete('/dashboard/master/product/edit/{id}', 'ProductController@delete')->name('db.master.product.delete');

    Route::post('/dashboard/master/product/create/add/unit/{product}', 'ProductController@addUnit');
    Route::post('/dashboard/master/product/create/remove/unit/{product}', 'ProductController@removeUnit');
    Route::post('/dashboard/master/product/edit/{id}/add/unit/{product}', 'ProductController@editAddUnit');
    Route::post('/dashboard/master/product/edit/{id}/remove/unit/{product}', 'ProductController@editRemoveUnit');

    Route::get('/dashboard/master/producttype', 'ProductTypeController@index')->name('db.master.producttype');
    Route::get('/dashboard/master/producttype/show/{id}', 'ProductTypeController@show')->name('db.master.producttype.show');
    Route::get('/dashboard/master/producttype/create', 'ProductTypeController@create')->name('db.master.producttype.create');
    Route::post('/dashboard/master/producttype/create', 'ProductTypeController@store');
    Route::get('/dashboard/master/producttype/edit/{id}', 'ProductTypeController@edit')->name('db.master.producttype.edit');
    Route::patch('/dashboard/master/producttype/edit/{id}', 'ProductTypeController@update');
    Route::delete('/dashboard/master/producttype/edit/{id}', 'ProductTypeController@delete')->name('db.master.producttype.delete');

    Route::get('/dashboard/master/warehouse', 'WarehouseController@index')->name('db.master.warehouse');
    Route::get('/dashboard/master/warehouse/show/{id}', 'WarehouseController@show')->name('db.master.warehouse.show');
    Route::get('/dashboard/master/warehouse/create', 'WarehouseController@create')->name('db.master.warehouse.create');
    Route::post('/dashboard/master/warehouse/create', 'WarehouseController@store');
    Route::get('/dashboard/master/warehouse/edit/{id}', 'WarehouseController@edit')->name('db.master.warehouse.edit');
    Route::patch('/dashboard/master/warehouse/edit/{id}', 'WarehouseController@update');
    Route::delete('/dashboard/master/warehouse/edit/{id}', 'WarehouseController@delete')->name('db.master.warehouse.delete');

    Route::get('/dashboard/master/bank', 'BankController@index')->name('db.master.bank');
    Route::get('/dashboard/master/bank/show/{id}', 'BankController@show')->name('db.master.bank.show');;
    Route::get('/dashboard/master/bank/create', 'BankController@create')->name('db.master.bank.create');;
    Route::post('/dashboard/master/bank/create', 'BankController@store');
    Route::get('/dashboard/master/bank/edit/{id}', 'BankController@edit')->name('db.master.bank.edit');;
    Route::patch('/dashboard/master/bank/edit/{id}', 'BankController@update');
    Route::delete('/dashboard/master/bank/edit/{id}', 'BankController@delete')->name('db.master.bank.delete');;

    Route::get('/dashboard/master/bank/upload', 'BankController@upload')->name('db.bank.upload');
    Route::post('/dashboard/master/bank/upload/{id}', 'BankController@store');

    Route::get('/dashboard/master/truck', 'TruckController@index')->name('db.master.truck');
    Route::get('/dashboard/master/truck/show/{id}', 'TruckController@show')->name('db.master.truck.show');
    Route::get('/dashboard/master/truck/create', 'TruckController@create')->name('db.master.truck.create');
    Route::post('/dashboard/master/truck/create/', 'TruckController@store');
    Route::get('/dashboard/master/truck/edit/{id}', 'TruckController@edit')->name('db.master.truck.edit');
    Route::patch('/dashboard/master/truck/edit/{id}', 'TruckController@update');
    Route::delete('/dashboard/master/truck/edit/{id}', 'TruckController@delete')->name('db.master.truck.delete');

    Route::get('/dashboard/truck/maintenance', 'TruckMaintenanceController@index')->name('db.truck.maintenance');
    Route::get('/dashboard/truck/maintenance/show/{id}', 'TruckMaintenanceController@show')->name('db.truck.maintenance.show');
    Route::get('/dashboard/truck/maintenance/create', 'TruckMaintenanceController@create')->name('db.truck.maintenance.create');
    Route::post('/dashboard/truck/maintenance/create', 'TruckMaintenanceController@store');
    Route::get('/dashboard/truck/maintenance/edit/{id}', 'TruckMaintenanceController@edit')->name('db.truck.maintenance.edit');
    Route::patch('/dashboard/truck/maintenance/edit/{id}', 'TruckMaintenanceController@update');

    Route::get('/dashboard/master/vendor/trucking', 'VendorTruckingController@index')->name('db.master.vendor.trucking');
    Route::get('/dashboard/master/vendor/trucking/show/{id}', 'VendorTruckingController@show')->name('db.master.vendor.trucking.show');
    Route::get('/dashboard/master/vendor/trucking/create', 'VendorTruckingController@create')->name('db.master.vendor.trucking.create');
    Route::post('/dashboard/master/vendor/trucking/create', 'VendorTruckingController@store');
    Route::get('/dashboard/master/vendor/trucking/edit/{id}', 'VendorTruckingController@edit')->name('db.master.vendor.trucking.edit');
    Route::patch('/dashboard/master/vendor/trucking/edit/{id}', 'VendorTruckingController@update');
    Route::delete('/dashboard/master/vendor/trucking/edit/{id}', 'VendorTruckingController@delete')->name('db.master.vendor.trucking.delete');

    Route::get('/dashboard/customer/confirmation', 'CustomerController@confirmation')->name('db.customer.confirmation');
    Route::get('/dashboard/customer/confirmation/{id}', 'CustomerController@confirmation');
    Route::patch('/dashboard/customer/confirmation/{id}', 'CustomerController@confirmation');

    Route::get('/dashboard/customer/approval', 'CustomerController@approval')->name('db.customer.approval');
    Route::get('/dashboard/customer/approval/{id}', 'CustomerController@approval');
    Route::patch('/dashboard/customer/approval/{id}', 'CustomerController@approval');

    Route::get('/dashboard/warehouse/inflow', 'WarehouseController@inflow')->name('db.warehouse.inflow');
    Route::get('/dashboard/warehouse/outflow', 'WarehouseController@inflow')->name('db.warehouse.outflow');
    Route::get('/dashboard/warehouse/stockopname', 'WarehouseController@stockopname')->name('db.warehouse.stockopname');

    Route::get('/dashboard/price/price_level', 'PriceLevelController@index')->name('db.price.price_level');
    Route::get('/dashboard/price/price_level/show/{id}', 'PriceLevelController@show')->name('db.price.price_level.show');
    Route::get('/dashboard/price/price_level/create', 'PriceLevelController@create')->name('db.price.price_level.create');
    Route::post('/dashboard/price/price_level/create', 'PriceLevelController@store');
    Route::get('/dashboard/price/price_level/edit/{id}', 'PriceLevelController@edit')->name('db.price.price_level.edit');
    Route::patch('/dashboard/price/price_level/edit/{id}', 'PriceLevelController@update');
    Route::delete('/dashboard/price/price_level/edit/{id}', 'PriceLevelController@delete')->name('db.price.price_level.delete');

    Route::get('/dashboard/po/create', 'PurchaseOrderController@create')->name('db.po.create');
    Route::post('/dashboard/po/create', 'PurchaseOrderController@create');

    Route::get('/dashboard/report/trx', 'ReportController@report_trx')->name('db.report.transaction');
    Route::get('/dashboard/report/mon', 'ReportController@report_mon')->name('db.report.monitoring');
    Route::get('/dashboard/report/tax', 'ReportController@report_tax')->name('db.report.tax');
    Route::get('/dashboard/report/master', 'ReportController@report_master')->name('db.report.master');
    Route::get('/dashboard/report/admin', 'ReportController@report_admin')->name('db.report.admin');
});

