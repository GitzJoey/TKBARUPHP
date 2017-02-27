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

Route::get('/forgot', function () {
    Route::get('', 'ForgotPasswordController@test');
});

Auth::routes();

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::bind('id', function ($id) {
        if (!is_numeric($id)) {
            return Hashids::decode($id)[0];
        } else {
            return $id;
        }
    });

    Route::group(['prefix' => 'front'], function () {
        Route::get('', 'FrontWebController@index')->name('fp');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('', 'DashboardController@index')->name('db');

        Route::group(['prefix' => 'acc'], function() {
            Route::group(['prefix' => 'cash'], function() {
                Route::get('', 'Accounting\CashAccountController@index')->name('db.acc.cash');
                Route::get('show/{id}', 'Accounting\CashAccountController@show')->name('db.acc.cash.show');
                Route::get('create', 'Accounting\CashAccountController@create')->name('db.acc.cash.create');
                Route::post('create', 'Accounting\CashAccountController@store');
                Route::get('edit/{id}', 'Accounting\CashAccountController@edit')->name('db.acc.cash.edit');
                Route::patch('edit/{id}', 'Accounting\CashAccountController@update');
                Route::delete('edit/{id}', 'Accounting\CashAccountController@delete')->name('db.acc.cash.delete');
            });

            Route::group(['prefix' => 'capital'], function() {
                Route::get('list/deposit', 'Accounting\CapitalController@listDeposit')->name('db.acc.capital.deposit.index');
                Route::get('/add/deposit', 'Accounting\CapitalController@addDeposit')->name('db.acc.capital.deposit.add');
                Route::post('/add/deposit', 'Accounting\CapitalController@saveDeposit');
                Route::get('list/withdrawal', 'Accounting\CapitalController@listWithdrawal')->name('db.acc.capital.withdrawal.index');
                Route::get('/add/withdrawal', 'Accounting\CapitalController@addWithdrawal')->name('db.acc.capital.withdrawal.add');
                Route::post('/add/withdrawal', 'Accounting\CapitalController@saveWithdrawal');
            });

            Route::group(['prefix' => 'cost'], function() {
                Route::get('', 'Accounting\CostController@index')->name('db.acc.cost');
                Route::get('create', 'Accounting\CostController@create')->name('db.acc.cost.create');
                Route::post('create', 'Accounting\CostController@store');
                Route::get('edit/{id}', 'Accounting\CostController@edit')->name('db.acc.cost.edit');
                Route::patch('edit/{id}', 'Accounting\CostController@update');

                Route::group(['prefix' => 'category'], function() {
                    Route::get('', 'Accounting\CostController@categoryIndex')->name('db.acc.cost.category');
                    Route::get('show/{id}', 'Accounting\CostController@categoryShow')->name('db.acc.cost.category.show');
                    Route::get('create', 'Accounting\CostController@categoryCreate')->name('db.acc.cost.category.create');
                    Route::post('create', 'Accounting\CostController@categoryStore');
                    Route::get('edit/{id}', 'Accounting\CostController@categoryEdit')->name('db.acc.cost.category.edit');
                    Route::patch('edit/{id}', 'Accounting\CostController@categoryUpdate');
                    Route::delete('edit/{id}', 'AccountingC\ostController@categoryDelete')->name('db.acc.cost.category.delete');
                });
            });

            Route::group(['prefix' => 'revenue'], function() {
                Route::get('', 'Accounting\RevenueController@index')->name('db.acc.revenue');
                Route::get('create', 'Accounting\RevenueController@create')->name('db.acc.revenue.create');
                Route::post('create', 'Accounting\RevenueController@store');
                Route::get('edit/{id}', 'Accounting\RevenueController@edit')->name('db.acc.revenue.edit');
                Route::patch('edit/{id}', 'Accounting\RevenueController@update');

                Route::group(['prefix' => 'category'], function() {
                    Route::get('', 'Accounting\RevenueController@categoryIndex')->name('db.acc.revenue.category');
                    Route::get('show/{id}', 'Accounting\RevenueController@categoryShow')->name('db.acc.revenue.category.show');
                    Route::get('create', 'Accounting\RevenueController@categoryCreate')->name('db.acc.revenue.category.create');
                    Route::post('create', 'Accounting\RevenueController@categoryStore');
                    Route::get('edit/{id}', 'Accounting\RevenueController@categoryEdit')->name('db.acc.revenue.category.edit');
                    Route::patch('edit/{id}', 'Accounting\RevenueController@categoryUpdate');
                    Route::delete('edit/{id}', 'Accounting\RevenueController@categoryDelete')->name('db.acc.revenue.category.delete');
                });
            });

            Route::group(['prefix' => 'cash_flow'], function() {
                Route::get('', 'Accounting\CashFlowController@index')->name('db.acc.cash_flow');
                Route::get('show/{id}', 'Accounting\CashFlowController@show')->name('db.acc.cash_flow.show');
                Route::get('create', 'Accounting\CashFlowController@create')->name('db.acc.cash_flow.create');
                Route::post('create', 'Accounting\CashFlowController@store');
                Route::get('edit/{id}', 'Accounting\CashFlowController@edit')->name('db.acc.cash_flow.edit');
                Route::patch('edit/{id}', 'Accounting\CashFlowController@update');
            });
        });

        Route::group(['prefix' => 'po'], function () {
            Route::get('create', 'PurchaseOrderController@create')->name('db.po.create');
            Route::post('create', 'PurchaseOrderController@store');
            Route::get('revise', 'PurchaseOrderController@index')->name('db.po.revise.index');
            Route::get('revise/{id}', 'PurchaseOrderController@revise')->name('db.po.revise');
            Route::patch('revise/{id}', 'PurchaseOrderController@saveRevision');
            Route::delete('reject/{id}', 'PurchaseOrderController@delete')->name('db.po.reject');

            Route::group(['prefix' => 'payment'], function () {
                Route::get('', 'PurchaseOrderPaymentController@paymentIndex')->name('db.po.payment.index');
                Route::get('{id}', 'PurchaseOrderPaymentController@paymentHistory')->name('db.po.payment.history');
                Route::get('{id}/cash', 'PurchaseOrderPaymentController@createCashPayment')->name('db.po.payment.cash');
                Route::post('{id}/cash', 'PurchaseOrderPaymentController@saveCashPayment');
                Route::get('{id}/transfer', 'PurchaseOrderPaymentController@createTransferPayment')
                    ->name('db.po.payment.transfer');
                Route::post('{id}/transfer', 'PurchaseOrderPaymentController@saveTransferPayment');
                Route::get('{id}/giro', 'PurchaseOrderPaymentController@createGiroPayment')->name('db.po.payment.giro');
                Route::post('{id}/giro', 'PurchaseOrderPaymentController@saveGiroPayment');
            });

            Route::group(['prefix' => 'copy'], function () {
                Route::get('', 'PurchaseOrderCopyController@search')->name('db.po.copy');
                Route::get('{code?}', 'PurchaseOrderCopyController@index')->name('db.po.copy.index');
                Route::get('{code}/create', 'PurchaseOrderCopyController@create')->name('db.po.copy.create');
                Route::post('{code}/create', 'PurchaseOrderCopyController@store');
                Route::get('{code}/edit/{id}', 'PurchaseOrderCopyController@edit')->name('db.po.copy.edit');
                Route::patch('{code}/edit/{id}', 'PurchaseOrderCopyController@update');
                Route::delete('{code}/delete/{id}', 'PurchaseOrderCopyController@delete')->name('db.po.copy.delete');
            });
        });

        Route::group(['prefix' => 'so'], function () {
            Route::get('create', 'SalesOrderController@create')->name('db.so.create');
            Route::post('create', 'SalesOrderController@store');
            Route::get('revise', 'SalesOrderController@index')->name('db.so.revise.index');
            Route::get('revise/{id}', 'SalesOrderController@revise')->name('db.so.revise');
            Route::patch('revise/{id}', 'SalesOrderController@saveRevision');
            Route::delete('reject/{id}', 'SalesOrderController@delete')->name('db.so.reject');

            Route::group(['prefix' => 'payment'], function () {
                Route::get('', 'SalesOrderPaymentController@paymentIndex')->name('db.so.payment.index');
                Route::get('{id}', 'SalesOrderPaymentController@paymentHistory')->name('db.so.payment.history');
                Route::get('{id}/cash', 'SalesOrderPaymentController@createCashPayment')->name('db.so.payment.cash');
                Route::post('{id}/cash', 'SalesOrderPaymentController@saveCashPayment');
                Route::get('{id}/transfer', 'SalesOrderPaymentController@createTransferPayment')
                    ->name('db.so.payment.transfer');
                Route::post('{id}/transfer', 'SalesOrderPaymentController@saveTransferPayment');
                Route::get('{id}/giro', 'SalesOrderPaymentController@createGiroPayment')->name('db.so.payment.giro');
                Route::post('{id}/giro', 'SalesOrderPaymentController@saveGiroPayment');
            });

            Route::group(['prefix' => 'copy'], function () {
                Route::get('', 'SalesOrderCopyController@search')->name('db.so.copy');
                Route::get('{code?}', 'SalesOrderCopyController@index')->name('db.so.copy.index');
                Route::get('{code}/create', 'SalesOrderCopyController@create')->name('db.so.copy.create');
                Route::post('{code}/create', 'SalesOrderCopyController@store');
                Route::get('{code}/edit/{id}', 'SalesOrderCopyController@edit')->name('db.so.copy.edit');
                Route::patch('{code}/edit/{id}', 'SalesOrderCopyController@update');
                Route::delete('{code}/delete/{id}', 'SalesOrderCopyController@delete')->name('db.so.copy.delete');
            });
        });

        Route::group(['prefix' => 'admin'], function () {
            Route::group(['prefix' => 'user'], function () {
                Route::get('', 'UserController@index')->name('db.admin.user');
                Route::get('show/{id}', 'UserController@show')->name('db.admin.user.show');
                Route::get('create', 'UserController@create')->name('db.admin.user.create');
                Route::post('create', 'UserController@store');
                Route::get('edit/{id}', 'UserController@edit')->name('db.admin.user.edit');
                Route::patch('edit/{id}', 'UserController@update');
                Route::delete('edit/{id}', 'UserController@delete')->name('db.admin.user.delete');
            });

            Route::group(['prefix' => 'roles'], function () {
                Route::get('', 'RolesController@index')->name('db.admin.roles');
                Route::get('show/{id}', 'RolesController@show')->name('db.admin.roles.show');
                Route::get('create', 'RolesController@create')->name('db.admin.roles.create');
                Route::post('create', 'RolesController@store');
                Route::get('edit/{id}', 'RolesController@edit')->name('db.admin.roles.edit');
                Route::patch('edit/{id}', 'RolesController@update');
                Route::delete('edit/{id}', 'RolesController@delete')->name('db.admin.roles.delete');
            });

            Route::group(['prefix' => 'store'], function () {
                Route::get('', 'StoreController@index')->name('db.admin.store');
                Route::get('show/{id}', 'StoreController@show')->name('db.admin.store.show');
                Route::get('create', 'StoreController@create')->name('db.admin.store.create');
                Route::post('create', 'StoreController@store');
                Route::get('edit/{id}', 'StoreController@edit')->name('db.admin.store.edit');
                Route::patch('edit/{id}', 'StoreController@update');
                Route::delete('edit/{id}', 'StoreController@delete')->name('db.admin.store.delete');
            });

            Route::group(['prefix' => 'unit'], function () {
                Route::get('', 'UnitController@index')->name('db.admin.unit');
                Route::get('show/{id}', 'UnitController@show')->name('db.admin.unit.show');
                Route::get('create', 'UnitController@create')->name('db.admin.unit.create');
                Route::post('create', 'UnitController@store');
                Route::get('edit/{id}', 'UnitController@edit')->name('db.admin.unit.edit');
                Route::patch('edit/{id}', 'UnitController@update');
                Route::delete('edit/{id}', 'UnitController@delete')->name('db.admin.unit.delete');
            });

            Route::group(['prefix' => 'phone'], function () {
                Route::get('provider', 'PhoneProviderController@index')->name('db.admin.phone_provider');
                Route::get('provider/show/{id}', 'PhoneProviderController@show')->name('db.admin.phone_provider.show');
                Route::get('provider/create', 'PhoneProviderController@create')->name('db.admin.phone_provider.create');
                Route::post('provider/create', 'PhoneProviderController@store');
                Route::get('provider/edit/{id}', 'PhoneProviderController@edit')->name('db.admin.phone_provider.edit');
                Route::patch('provider/edit/{id}', 'PhoneProviderController@update');
                Route::delete('provider/edit/{id}', 'PhoneProviderController@delete')->name('db.admin.phone_provider.delete');
            });

            Route::group(['prefix' => 'settings'], function () {
                Route::get('', 'SettingsController@index')->name('db.admin.settings');
                Route::get('update}', 'SettingsController@update')->name('db.admin.settings.update');
            });
        });

        Route::group(['prefix' => 'master'], function () {
            Route::group(['prefix' => 'customer'], function () {
                Route::get('', 'CustomerController@index')->name('db.master.customer');
                Route::get('show/{id}', 'CustomerController@show')->name('db.master.customer.show');
                Route::get('create', 'CustomerController@create')->name('db.master.customer.create');
                Route::post('create', 'CustomerController@store');
                Route::get('edit/{id}', 'CustomerController@edit')->name('db.master.customer.edit');
                Route::patch('edit/{id}', 'CustomerController@update');
                Route::delete('edit/{id}', 'CustomerController@delete')->name('db.master.customer.delete');
            });

            Route::group(['prefix' => 'supplier'], function () {
                Route::get('', 'SupplierController@index')->name('db.master.supplier');
                Route::get('show/{id}', 'SupplierController@show')->name('db.master.supplier.show');
                Route::get('create', 'SupplierController@create')->name('db.master.supplier.create');
                Route::post('create', 'SupplierController@store');
                Route::get('edit/{id}', 'SupplierController@edit')->name('db.master.supplier.edit');
                Route::patch('edit/{id}', 'SupplierController@update');
                Route::delete('edit/{id}', 'SupplierController@delete')->name('db.master.supplier.delete');
            });

            Route::group(['prefix' => 'product'], function () {
                Route::get('', 'ProductController@index')->name('db.master.product');
                Route::get('show/{id}', 'ProductController@show')->name('db.master.product.show');
                Route::get('create', 'ProductController@create')->name('db.master.product.create');
                Route::post('create', 'ProductController@store');
                Route::get('edit/{id}', 'ProductController@edit')->name('db.master.product.edit');
                Route::patch('edit/{id}', 'ProductController@update');
                Route::delete('edit/{id}', 'ProductController@delete')->name('db.master.product.delete');
            });

            Route::group(['prefix' => 'producttype'], function () {
                Route::get('', 'ProductTypeController@index')->name('db.master.producttype');
                Route::get('show/{id}', 'ProductTypeController@show')->name('db.master.producttype.show');
                Route::get('create', 'ProductTypeController@create')->name('db.master.producttype.create');
                Route::post('create', 'ProductTypeController@store');
                Route::get('edit/{id}', 'ProductTypeController@edit')->name('db.master.producttype.edit');
                Route::patch('edit/{id}', 'ProductTypeController@update');
                Route::delete('edit/{id}', 'ProductTypeController@delete')->name('db.master.producttype.delete');
            });

            Route::group(['prefix' => 'warehouse'], function () {
                Route::get('', 'WarehouseController@index')->name('db.master.warehouse');
                Route::get('show/{id}', 'WarehouseController@show')->name('db.master.warehouse.show');
                Route::get('create', 'WarehouseController@create')->name('db.master.warehouse.create');
                Route::post('create', 'WarehouseController@store');
                Route::get('edit/{id}', 'WarehouseController@edit')->name('db.master.warehouse.edit');
                Route::patch('edit/{id}', 'WarehouseController@update');
                Route::delete('edit/{id}', 'WarehouseController@delete')->name('db.master.warehouse.delete');

                Route::group(['prefix' => 'inflow'], function() {
                    Route::get('', 'WarehouseInflowController@inflow')->name('db.warehouse.inflow.index');
                    Route::get('receipt/{id?}', 'WarehouseInflowController@receipt')->name('db.warehouse.inflow');
                    Route::post('receipt/{id?}', 'WarehouseInflowController@saveReceipt');
                });

                Route::group(['prefix' => 'outflow'], function() {
                    Route::get('', 'WarehouseOutflowController@outflow')->name('db.warehouse.outflow.index');
                    Route::get('deliver/{id?}', 'WarehouseOutflowController@deliver')->name('db.warehouse.outflow');
                    Route::post('deliver/{id?}', 'WarehouseOutflowController@saveDeliver');
                });

                Route::group(['prefix' => 'stockopname'], function () {
                    Route::get('', 'WarehouseController@stockopname')->name('db.warehouse.stockopname.index');
                    Route::get('adjust/{id}', 'WarehouseController@adjust')->name('db.warehouse.stockopname.adjust');
                    Route::post('adjust/{id}', 'WarehouseController@saveAdjustment');
                });

                Route::group(['prefix' => 'trf/stock'], function() {
                    Route::get('', 'WarehouseTransferStockController@index')->name('db.warehouse.transfer_stock.index');
                    Route::get('transfer', 'WarehouseTransferStockController@transfer')->name('db.warehouse.transfer_stock.transfer');
                });
            });

            Route::group(['prefix' => 'bank'], function () {
                Route::get('', 'BankController@index')->name('db.master.bank');
                Route::get('show/{id}', 'BankController@show')->name('db.master.bank.show');
                Route::get('create', 'BankController@create')->name('db.master.bank.create');
                Route::post('create', 'BankController@store');
                Route::get('edit/{id}', 'BankController@edit')->name('db.master.bank.edit');
                Route::patch('edit/{id}', 'BankController@update');
                Route::delete('edit/{id}', 'BankController@delete')->name('db.master.bank.delete');
            });

            Route::group(['prefix' => 'truck'], function () {
                Route::get('', 'TruckController@index')->name('db.master.truck');
                Route::get('show/{id}', 'TruckController@show')->name('db.master.truck.show');
                Route::get('create', 'TruckController@create')->name('db.master.truck.create');
                Route::post('create/', 'TruckController@store');
                Route::get('edit/{id}', 'TruckController@edit')->name('db.master.truck.edit');
                Route::patch('edit/{id}', 'TruckController@update');
                Route::delete('edit/{id}', 'TruckController@delete')->name('db.master.truck.delete');
            });

            Route::group(['prefix' => 'salary'], function () {
                Route::get('', 'SalaryController@index')->name('db.master.salary');
                Route::get('show/{id}', 'SalaryController@show')->name('db.master.salary.show');
                Route::get('create', 'SalaryController@create')->name('db.master.salary.create');
                Route::post('create/', 'SalaryController@store');
                Route::get('edit/{id}', 'SalaryController@edit')->name('db.master.salary.edit');
                Route::patch('edit/{id}', 'SalaryController@update');
                Route::delete('edit/{id}', 'SalaryController@delete')->name('db.master.salary.delete');
            });

            Route::group(['prefix' => 'vendor'], function () {
                Route::get('trucking', 'VendorTruckingController@index')->name('db.master.vendor.trucking');
                Route::get('trucking/show/{id}', 'VendorTruckingController@show')->name('db.master.vendor.trucking.show');
                Route::get('trucking/create', 'VendorTruckingController@create')->name('db.master.vendor.trucking.create');
                Route::post('trucking/create', 'VendorTruckingController@store');
                Route::get('trucking/edit/{id}', 'VendorTruckingController@edit')->name('db.master.vendor.trucking.edit');
                Route::patch('trucking/edit/{id}', 'VendorTruckingController@update');
                Route::delete('trucking/edit/{id}', 'VendorTruckingController@delete')->name('db.master.vendor.trucking.delete');
            });

            Route::group(['prefix' => 'expense_template'], function () {
                Route::get('', 'ExpenseTemplateController@index')->name('db.master.expense_template');
                Route::get('show/{id}', 'ExpenseTemplateController@show')->name('db.master.expense_template.show');
                Route::get('create', 'ExpenseTemplateController@create')->name('db.master.expense_template.create');
                Route::post('create/', 'ExpenseTemplateController@store');
                Route::get('edit/{id}', 'ExpenseTemplateController@edit')->name('db.master.expense_template.edit');
                Route::patch('edit/{id}', 'ExpenseTemplateController@update');
                Route::delete('edit/{id}', 'ExpenseTemplateController@delete')->name('db.master.expense_template.delete');
            });
        });

        Route::group(['prefix' => 'bank'], function () {
            Route::get('upload', 'BankController@upload')->name('db.bank.upload');
            Route::post('upload', 'BankController@storeUpload');

            Route::group(['prefix' => 'giro'], function () {
                Route::get('', 'GiroController@index')->name('db.bank.giro');
                Route::get('show/{id}', 'GiroController@show')->name('db.bank.giro.show');
                Route::get('create', 'GiroController@create')->name('db.bank.giro.create');
                Route::post('create', 'GiroController@store');
                Route::get('edit/{id}', 'GiroController@edit')->name('db.bank.giro.edit');
                Route::patch('edit/{id}', 'GiroController@update');
                Route::delete('edit/{id}', 'GiroController@delete')->name('db.bank.giro.delete');
                route::post('override_confirm/{id}', 'GiroController@overrideConfirm')->name('db.bank.giro.override_confirm');
            });

            Route::group(['prefix' => 'consolidate'], function (){
                Route::get('', 'BankConsolidateController@index')->name('db.bank.consolidate');
            });
        });

        Route::group(['prefix' => 'truck'], function () {
            Route::get('maintenance', 'TruckMaintenanceController@index')->name('db.truck.maintenance');
            Route::get('maintenance/show/{id}', 'TruckMaintenanceController@show')->name('db.truck.maintenance.show');
            Route::get('maintenance/create', 'TruckMaintenanceController@create')->name('db.truck.maintenance.create');
            Route::post('maintenance/create', 'TruckMaintenanceController@store');
            Route::get('maintenance/edit/{id}', 'TruckMaintenanceController@edit')->name('db.truck.maintenance.edit');
            Route::patch('maintenance/edit/{id}', 'TruckMaintenanceController@update');
        });

        Route::group(['prefix' => 'employee'], function () {
            Route::get('', 'EmployeeController@index')->name('db.employee.employee');
            Route::get('show/{id}', 'EmployeeController@show')->name('db.employee.employee.show');
            Route::get('create', 'EmployeeController@create')->name('db.employee.employee.create');
            Route::post('create/', 'EmployeeController@store');
            Route::get('edit/{id}', 'EmployeeController@edit')->name('db.employee.employee.edit');
            Route::patch('edit/{id}', 'EmployeeController@update');
            Route::delete('edit/{id}', 'EmployeeController@delete')->name('db.employee.employee.delete');
        });
        Route::group(['prefix' => 'historyEmployeeSalary'], function () {
            Route::get('', 'HistoryEmployeeSalaryController@index')->name('db.employee.employee_salary');
            Route::get('calculate_salary', 'HistoryEmployeeSalaryController@calculateSalary')->name('db.employee.employee_salary.calculate_salary');
            Route::get('show/{id}', 'HistoryEmployeeSalaryController@show')->name('db.employee.employee_salary.show');
            Route::get('create', 'HistoryEmployeeSalaryController@create')->name('db.employee.employee_salary.create');
            Route::post('create/', 'HistoryEmployeeSalaryController@store');
            Route::get('edit/{id}', 'HistoryEmployeeSalaryController@edit')->name('db.employee.employee_salary.edit');
            Route::patch('edit/{id}', 'HistoryEmployeeSalaryController@update');
            Route::delete('edit/{id}', 'HistoryEmployeeSalaryController@delete')->name('db.employee.employee_salary.delete');
        });
        Route::group(['prefix' => 'customer'], function () {
            Route::get('confirmation', 'CustomerController@confirmationIndex')->name('db.customer.confirmation.index');
            Route::get('confirmation/{id}', 'CustomerController@confirmationCustomer')->name('db.customer.confirmation.customer');
            Route::get('confirmation/confirm/{id}', 'CustomerController@confirmSalesOrder')->name('db.customer.confirmation.confirm');
            Route::post('confirmation/confirm/{id}', 'CustomerController@storeConfirmationSalesOrder');

            Route::get('payment', 'CustomerController@paymentIndex')->name('db.customer.payment.index');
            Route::get('payment/cash/{id}', 'CustomerController@paymentCashCustomer')->name('db.customer.payment.cash');
            Route::post('payment/cash/{id}', 'CustomerController@storePaymentCashCustomer');
            Route::get('payment/transfer/{id}', 'CustomerController@paymentTransferCustomer')->name('db.customer.payment.transfer');
            Route::post('payment/transfer/{id}', 'CustomerController@storePaymentTransferCustomer');
            Route::get('payment/giro/{id}', 'CustomerController@paymentGiroCustomer')->name('db.customer.payment.giro');
            Route::post('payment/giro/{id}', 'CustomerController@storePaymentGiroCustomer');

            Route::get('approval', 'CustomerController@approvalIndex')->name('db.customer.approval.index');
            Route::get('approval/approve/{id}', 'CustomerController@approval')->name('db.customer.approval.approve');
            Route::get('approval/reject/{id}', 'CustomerController@reject')->name('db.customer.approval.reject');
        });

        Route::group(['prefix' => 'price'], function () {
            Route::group(['prefix' => 'price_level'], function () {
                Route::get('', 'PriceLevelController@index')->name('db.price.price_level');
                Route::get('show/{id}', 'PriceLevelController@show')->name('db.price.price_level.show');
                Route::get('create', 'PriceLevelController@create')->name('db.price.price_level.create');
                Route::post('create', 'PriceLevelController@store');
                Route::get('edit/{id}', 'PriceLevelController@edit')->name('db.price.price_level.edit');
                Route::patch('edit/{id}', 'PriceLevelController@update');
                Route::delete('edit/{id}', 'PriceLevelController@delete')->name('db.price.price_level.delete');
            });

            Route::get('today', 'PriceController@index')->name('db.price.today');
            Route::get('category/{id}', 'PriceController@editCategoryPrice')->name('db.price.category');
            Route::post('category/{id}', 'PriceController@updateCategoryPrice');
            Route::get('stock/{id}', 'PriceController@editStockPrice')->name('db.price.stock');
            Route::post('stock/{id}', 'PriceController@updateStockPrice');
        });

        Route::group(['prefix' => 'report'], function () {
            Route::group(['prefix' => 'trx'], function () {
                Route::get('', 'ReportController@report_trx')->name('db.report.transaction');
                Route::post('purchase_order', 'ReportTransactionController@generatePurchaseOrderReport')->name('db.report.trx.po');
                Route::post('sales_order', 'ReportTransactionController@generateSalesOrderReport')->name('db.report.trx.so');
            });

            Route::group(['prefix' => 'mon'], function () {
                Route::get('', 'ReportController@report_mon')->name('db.report.monitoring');
            });

            Route::group(['prefix' => 'tax'], function () {
                Route::get('', 'ReportController@report_tax')->name('db.report.tax');
            });

            Route::group(['prefix' => 'master'], function () {
                Route::get('', 'ReportController@report_master')->name('db.report.master');
                Route::post('customer', 'ReportMasterController@generateCustomerReport')->name('db.report.master.customer');
                Route::post('supplier', 'ReportMasterController@generateSupplierReport')->name('db.report.master.supplier');
                Route::post('product', 'ReportMasterController@generateProductReport')->name('db.report.master.product');
                Route::post('product_type', 'ReportMasterController@generateProductTypeReport')->name('db.report.master.product_type');
                Route::post('warehouse', 'ReportMasterController@generateWarehouseReport')->name('db.report.master.warehouse');
                Route::post('bank', 'ReportMasterController@generateBankReport')->name('db.report.master.bank');
                Route::post('truck', 'ReportMasterController@generateTruckReport')->name('db.report.master.truck');
                Route::post('truck_maintenance', 'ReportMasterController@generateTruckMaintenanceReport')->name('db.report.master.truck_maintenance');
                Route::post('vendor_trucking', 'ReportMasterController@generateVendorTruckingReport')->name('db.report.master.vendor_trucking');
                Route::post('expensetemplates', 'ReportMasterController@generateExpenseTemplatesReport')->name('db.report.master.expense_templates');
            });

            Route::group(['prefix' => 'admin'], function () {
                Route::get('', 'ReportController@report_admin')->name('db.report.admin');
                Route::post('user', 'ReportAdminController@generateUserReport')->name('db.report.admin.user');
                Route::post('role', 'ReportAdminController@generateRoleReport')->name('db.report.admin.role');
                Route::post('store', 'ReportAdminController@generateStoreReport')->name('db.report.admin.store');
                Route::post('unit', 'ReportADminController@generateUnitReport')->name('db.report.admin.unit');
                Route::post('phone_provider', 'ReportAdminController@generatePhoneProviderReport')->name('db.report.admin.phone_provider');
                Route::post('settings', 'ReportAdminController@generateSettingsReport')->name('db.report.admin.settings');
            });

            Route::get('view/{fileName}', 'ReportController@view')->name('db.report.view');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('profile/{id}', 'UserController@profile')->name('db.user.profile.show');

            Route::get('calendar', 'CalendarController@index')->name('db.user.calendar.show');
            Route::get('calendar/retrieve', 'CalendarController@retrieveEvents')->name('db.user.calendar.retrieve');
            Route::post('calendar/save', 'CalendarController@storeEvent')->name('db.user.calendar.store');

            Route::get('settings', 'SettingsController@userSettings')->name('db.user.settings.show');
            Route::get('settings/update', 'SettingsController@userSettingsUpdate')->name('db.user.settings.update');
        });


        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('db.logs');
    });

    Route::get('/home', 'HomeController@index');
});

