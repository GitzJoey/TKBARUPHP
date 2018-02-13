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

Route::get('forgot', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm');

Route::get('activate/{token}', 'Auth\RegisterController@activate');
Route::post('activate/resend', 'Auth\RegisterController@activateResend');

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
        Route::get('start/tour', 'DashboardController@tour')->name('db.tour');

        Route::group(['prefix' => 'acc', 'middleware' => 'role:owner|admin'], function() {
            Route::group(['prefix' => 'cash'], function() {
                Route::get('', 'Accounting\CashAccountController@index')->name('db.acc.cash');
                Route::get('show/{id}', 'Accounting\CashAccountController@show')->name('db.acc.cash.show');
                Route::get('create', 'Accounting\CashAccountController@create')->name('db.acc.cash.create');
                Route::get('edit/{id}', 'Accounting\CashAccountController@edit')->name('db.acc.cash.edit');
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
                    Route::delete('edit/{id}', 'Accounting\CostController@categoryDelete')->name('db.acc.cost.category.delete');
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
            Route::get('revise', 'PurchaseOrderController@index')->name('db.po.revise.index');
            Route::get('revise/{id}', 'PurchaseOrderController@revise')->name('db.po.revise');
            Route::delete('reject/{id}', 'PurchaseOrderController@delete')->name('db.po.reject');

            Route::group(['prefix' => 'payment'], function () {
                Route::get('', 'PurchaseOrderPaymentController@paymentIndex')->name('db.po.payment.index');
                Route::get('{id}', 'PurchaseOrderPaymentController@paymentHistory')->name('db.po.payment.history');
                Route::get('{id}/cash', 'PurchaseOrderPaymentController@createCashPayment')->name('db.po.payment.cash');
                Route::get('{id}/transfer', 'PurchaseOrderPaymentController@createTransferPayment')->name('db.po.payment.transfer');
                Route::get('{id}/giro', 'PurchaseOrderPaymentController@createGiroPayment')->name('db.po.payment.giro');
            });

            Route::group(['prefix' => 'copy'], function () {
                Route::get('', 'PurchaseOrderCopyController@search')->name('db.po.copy');
                Route::get('{code?}', 'PurchaseOrderCopyController@index')->name('db.po.copy.index');
                Route::get('{code}/create', 'PurchaseOrderCopyController@create')->name('db.po.copy.create');
                Route::get('{code}/edit/{id}', 'PurchaseOrderCopyController@edit')->name('db.po.copy.edit');
                Route::delete('{code}/delete/{id}', 'PurchaseOrderCopyController@delete')->name('db.po.copy.delete');
            });
        });

        Route::group(['prefix' => 'so'], function () {
            Route::get('create', 'SalesOrderController@create')->name('db.so.create');
            Route::get('revise', 'SalesOrderController@index')->name('db.so.revise.index');
            Route::get('revise/{id}', 'SalesOrderController@revise')->name('db.so.revise');
            Route::delete('reject/{id}', 'SalesOrderController@delete')->name('db.so.reject');

            Route::group(['prefix' => 'payment'], function () {
                Route::get('', 'SalesOrderPaymentController@paymentIndex')->name('db.so.payment.index');
                Route::get('{id}', 'SalesOrderPaymentController@paymentHistory')->name('db.so.payment.history');
                Route::get('{id}/cash', 'SalesOrderPaymentController@createCashPayment')->name('db.so.payment.cash');
                Route::get('{id}/transfer', 'SalesOrderPaymentController@createTransferPayment')->name('db.so.payment.transfer');
                Route::get('{id}/giro', 'SalesOrderPaymentController@createGiroPayment')->name('db.so.payment.giro');
                Route::get('{id}/bf', 'SalesOrderPaymentController@createBroughtForwardPayment')->name('db.so.payment.bf');
            });

            Route::group(['prefix' => 'copy'], function () {
                Route::get('', 'SalesOrderCopyController@search')->name('db.so.copy');
                Route::get('{code?}', 'SalesOrderCopyController@index')->name('db.so.copy.index');
                Route::get('{code}/create', 'SalesOrderCopyController@create')->name('db.so.copy.create');
                Route::get('{code}/edit/{id}', 'SalesOrderCopyController@edit')->name('db.so.copy.edit');
                Route::delete('{code}/delete/{id}', 'SalesOrderCopyController@delete')->name('db.so.copy.delete');
            });
        });

        Route::group(['prefix' => 'price'], function () {
            Route::get('today', 'PriceController@index')->name('db.price.today');
            Route::get('today/download', 'PriceController@download')->name('db.price.today.download');
            Route::get('category/{id}', 'PriceController@editCategoryPrice')->name('db.price.category');
            Route::get('stock/{id}', 'PriceController@editStockPrice')->name('db.price.stock');

            Route::group(['prefix' => 'price_level', 'middleware' => ['permission:create-pricelevel|read-pricelevel|update-pricelevel|delete-pricelevel|menu-pricelevel']], function () {
                Route::get('', 'PriceLevelController@index')->name('db.price.price_level');
                Route::get('show/{id}', 'PriceLevelController@show')->name('db.price.price_level.show');
                Route::get('create', 'PriceLevelController@create')->name('db.price.price_level.create');
                Route::get('edit/{id}', 'PriceLevelController@edit')->name('db.price.price_level.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-pricelevel'], 'uses' => 'PriceLevelController@delete'])->name('db.price.price_level.delete');
            });
        });

        Route::group(['prefix' => 'warehouse'], function() {
            Route::group(['prefix' => 'inflow', 'middleware' => ['permission:create-warehouse_inflow|read-warehouse_inflow|menu-warehouse_inflow']], function() {
                Route::get('', 'WarehouseInflowController@inflow')->name('db.warehouse.inflow.index');
                Route::get('receipt/{id?}', 'WarehouseInflowController@receipt')->name('db.warehouse.inflow');
            });

            Route::group(['prefix' => 'outflow', 'middleware' => ['permission:create-warehouse_outflow|read-warehouse_outflow|menu-warehouse_outflow']], function() {
                Route::get('', 'WarehouseOutflowController@outflow')->name('db.warehouse.outflow.index');
                Route::get('deliver/{id?}', 'WarehouseOutflowController@deliver')->name('db.warehouse.outflow');
            });

            Route::group(['prefix' => 'stockopname', 'middleware' => ['permission:create-warehouse_stockopname|read-warehouse_stockopname|menu-warehouse_stockopname']], function () {
                Route::get('', 'WarehouseController@stockopname')->name('db.warehouse.stockopname.index');
                Route::get('adjust/{id}', 'WarehouseController@adjust')->name('db.warehouse.stockopname.adjust');
                Route::post('adjust/{id}', 'WarehouseController@saveAdjustment');
            });

            Route::group(['prefix' => 'trf/stock', 'middleware' => ['permission:create-warehouse_transferstock|read-warehouse_transferstock|menu-warehouse_transferstock']], function() {
                Route::get('', 'WarehouseTransferStockController@index')->name('db.warehouse.transfer_stock.index');
                Route::get('show/{id}', 'WarehouseTransferStockController@show')->name('db.warehouse.transfer_stock.show');
                Route::get('transfer', 'WarehouseTransferStockController@transfer')->name('db.warehouse.transfer_stock.transfer');
            });

            Route::group(['prefix' => 'stock/merger', 'middleware' => ['permission:create-warehouse_stockmerger|read-warehouse_stockmerger|menu-warehouse_stockmerger']], function() {
                Route::get('', 'StockController@mergerIndex')->name('db.warehouse.stock_merger.index');
                Route::get('create', 'StockController@mergerCreate')->name('db.warehouse.stock_merger.create');
                Route::get('show/{id}', 'StockController@mergerShow')->name('db.warehouse.stock_merger.show');
            });
        });

        Route::group(['prefix' => 'bank', 'middleware' => ['permission:create-bank_upload|read-bank_upload|menu-bank_upload']], function () {
            Route::get('upload', 'BankController@upload')->name('db.bank.upload');
            Route::post('upload', 'BankController@storeUpload');

            Route::group(['prefix' => 'giro', 'middleware' => ['permission:create-bank_giro|read-bank_giro|update-bank_giro|delete-bank_giro|menu-bank_giro']], function () {
                Route::get('', 'GiroController@index')->name('db.bank.giro');
                Route::get('show/{id}', 'GiroController@show')->name('db.bank.giro.show');
                Route::get('create', 'GiroController@create')->name('db.bank.giro.create');
                Route::get('edit/{id}', 'GiroController@edit')->name('db.bank.giro.edit');
                Route::delete('edit/{id}', 'GiroController@delete')->name('db.bank.giro.delete');
                Route::post('override_confirm/{id}', 'GiroController@overrideConfirm')->name('db.bank.giro.override_confirm');
            });

            Route::group(['prefix' => 'consolidate'], function (){
                Route::get('', 'BankConsolidateController@index')->name('db.bank.consolidate');
            });
        });

        Route::group(['prefix' => 'customer'], function () {
            Route::group(['prefix' => 'confirmation', 'middleware' => ['permission:menu-customer_confirmation']], function() {
                Route::get('', 'CustomerController@confirmationIndex')->name('db.customer.confirmation.index');
                Route::get('{id}', 'CustomerController@confirmationCustomer')->name('db.customer.confirmation.customer');
                Route::get('confirm/{id}', 'CustomerController@confirmSalesOrder')->name('db.customer.confirmation.confirm');

            });

            Route::group(['prefix' => 'payment', 'middleware' => ['permission:menu-customer_payment']], function() {
                Route::get('', 'CustomerController@paymentIndex')->name('db.customer.payment.index');
                Route::get('cash/{id}', 'CustomerController@paymentCashCustomer')->name('db.customer.payment.cash');
                Route::get('transfer/{id}', 'CustomerController@paymentTransferCustomer')->name('db.customer.payment.transfer');
                Route::get('giro/{id}', 'CustomerController@paymentGiroCustomer')->name('db.customer.payment.giro');
            });

            Route::group(['prefix' => 'approval', 'middleware' => ['permission:menu-customer_approval']], function() {
                Route::get('', 'CustomerController@approvalIndex')->name('db.customer.approval.index');
                Route::get('approve/{id}', 'CustomerController@approval')->name('db.customer.approval.approve');
                Route::get('reject/{id}', 'CustomerController@reject')->name('db.customer.approval.reject');
            });
        });

        Route::group(['prefix' => 'truck', 'middleware' => ['permission:create-truck_maintenance|read-truck_maintenance|update-truck_maintenance|delete-truck_maintenance|menu-truck_maintenance']], function () {
            Route::get('maintenance', 'TruckMaintenanceController@index')->name('db.truck.maintenance');
            Route::get('maintenance/show/{id}', 'TruckMaintenanceController@show')->name('db.truck.maintenance.show');
            Route::get('maintenance/create', 'TruckMaintenanceController@create')->name('db.truck.maintenance.create');
            Route::get('maintenance/edit/{id}', 'TruckMaintenanceController@edit')->name('db.truck.maintenance.edit');
        });

        Route::group(['prefix' => 'employee', 'middleware' => ['permission:create-employee|read-employee|update-employee|delete-employee|menu-employee']], function () {
            Route::get('', 'EmployeeController@index')->name('db.employee.employee');
            Route::get('show/{id}', 'EmployeeController@show')->name('db.employee.employee.show');
            Route::get('create', 'EmployeeController@create')->name('db.employee.employee.create');
            Route::get('edit/{id}', 'EmployeeController@edit')->name('db.employee.employee.edit');
            Route::delete('edit/{id}', 'EmployeeController@delete')->name('db.employee.employee.delete');

            Route::group(['prefix' => 'salary', 'middleware' => ['permission:create-employeesalary|read-employeesalary|update-employeesalary|delete-employeesalary|menu-employeesalary']], function () {
                Route::get('', 'EmployeeSalaryHistController@index')->name('db.employee.employee_salary');
                Route::get('calculate_salary', 'EmployeeSalaryHistController@calculateSalary')->name('db.employee.employee_salary.calculate_salary');
                Route::get('show/{id}', 'EmployeeSalaryHistController@show')->name('db.employee.employee_salary.show');
                Route::get('create', 'EmployeeSalaryHistController@create')->name('db.employee.employee_salary.create');
                Route::post('create/', 'EmployeeSalaryHistController@store');
                Route::get('edit/{id}', 'EmployeeSalaryHistController@edit')->name('db.employee.employee_salary.edit');
                Route::patch('edit/{id}', 'EmployeeSalaryHistController@update');
                Route::delete('edit/{id}', 'EmployeeSalaryHistController@delete')->name('db.employee.employee_salary.delete');
            });
        });

        Route::group(['prefix' => 'tax'], function () {
            Route::group(['prefix' => 'invoice'], function () {
                Route::group(['prefix' => 'output', 'middleware' => ['permission:create-tax-output|read-tax-output|update-tax-output|delete-tax-output|menu-tax-output']], function () {
                    Route::get('', 'TaxInvoiceOutputController@index')->name('db.tax.invoice.output.index');
                    Route::get('show/{id}', 'TaxInvoiceOutputController@show')->name('db.tax.invoice.output.show');
                    Route::get('create', 'TaxInvoiceOutputController@create')->name('db.tax.invoice.output.create');
                    Route::post('create/', 'TaxInvoiceOutputController@store');
                    Route::get('edit/{id}', 'TaxInvoiceOutputController@edit')->name('db.tax.invoice.output.edit');
                    Route::patch('edit/{id}', 'TaxInvoiceOutputController@update');
                    Route::delete('edit/{id}', 'TaxInvoiceOutputController@delete')->name('db.tax.invoice.output.delete');
                });
                Route::group(['middleware' => ['permission:create-tax-input|read-tax-input|update-tax-input|delete-tax-input|menu-tax-input']], function () {
                    Route::resource('input', 'TaxInvoiceInputController', [
                        'as' => 'db.tax.invoice',
                        'parameters' => [
                            'input' => 'id'
                        ]
                    ]);
                });
            });
            Route::group(['middleware' => ['permission:read-tax-generate|menu-tax-generate']], function () {
              Route::get('generate', 'TaxGenerateController@index')->name('db.tax.generate');
              Route::get('generate/import_pk/{format}', 'TaxGenerateController@indexImportPkExcel')->name('db.tax.generate.import_pk.excel');
              Route::get('generate/import_pm/{format}', 'TaxGenerateController@indexImportPmExcel')->name('db.tax.generate.import_pm.excel');
            });
        });

        Route::group(['prefix' => 'report'], function () {
            Route::group(['prefix' => 'trx', 'middleware' => ['permission:menu-report_transaction']], function () {
                Route::get('', 'ReportController@report_trx')->name('db.report.transaction');
                Route::post('purchase_order', 'ReportTransactionController@generatePurchaseOrderReport')->name('db.report.trx.po');
                Route::post('sales_order', 'ReportTransactionController@generateSalesOrderReport')->name('db.report.trx.so');
                Route::post('summary/purchase_order', 'ReportTransactionController@generatePurchaseOrderSummaryReport')->name('db.report.trx.po.summary');
                Route::post('summary/sales_order', 'ReportTransactionController@generateSalesOrderSummaryReport')->name('db.report.trx.so.summary');
            });

            Route::group(['prefix' => 'mon', 'middleware' => ['permission:menu-report_monitoring']], function () {
                Route::get('', 'ReportController@report_mon')->name('db.report.monitoring');
                Route::get('stocks/download', 'ReportController@downloadStock')->name('db.report.monitoring.stocks.download');
            });

            Route::group(['prefix' => 'tax', 'middleware' => ['permission:menu-report_tax']], function () {
                Route::get('/{year?}/{month?}', 'ReportController@report_tax')->name('db.report.tax');
            });

            Route::group(['prefix' => 'master', 'middleware' => ['permission:menu-report_master']], function () {
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

            Route::group(['prefix' => 'admin', 'middleware' => ['permission:menu-report_admin']], function () {
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

        Route::group(['prefix' => 'master'], function () {
            Route::group(['prefix' => 'customer', 'middleware' => ['permission:create-customer|read-customer|update-customer|delete-customer|menu-customer']], function () {
                Route::get('', 'CustomerController@index')->name('db.master.customer');
                Route::get('show/{id}', 'CustomerController@show')->name('db.master.customer.show');
                Route::get('create', 'CustomerController@create')->name('db.master.customer.create');
                Route::get('edit/{id}', 'CustomerController@edit')->name('db.master.customer.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-customer'], 'uses' => 'CustomerController@delete'])->name('db.master.customer.delete');
            });

            Route::group(['prefix' => 'supplier', 'middleware' => ['permission:create-supplier|read-supplier|update-supplier|delete-supplier|menu-supplier']], function () {
                Route::get('', 'SupplierController@index')->name('db.master.supplier');
                Route::get('show/{id}', 'SupplierController@show')->name('db.master.supplier.show');
                Route::get('create', 'SupplierController@create')->name('db.master.supplier.create');
                Route::get('edit/{id}', 'SupplierController@edit')->name('db.master.supplier.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-supplier'], 'uses' => 'SupplierController@delete'])->name('db.master.supplier.delete');
            });

            Route::group(['prefix' => 'product', 'middleware' => ['permission:create-supplier|read-supplier|update-supplier|delete-supplier|menu-supplier']], function () {
                Route::get('', 'ProductController@index')->name('db.master.product');
                Route::get('show/{id}', 'ProductController@show')->name('db.master.product.show');
                Route::get('create', 'ProductController@create')->name('db.master.product.create');
                Route::get('edit/{id}', 'ProductController@edit')->name('db.master.product.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-product'], 'uses' => 'ProductController@delete'])->name('db.master.product.delete');
            });

            Route::group(['prefix' => 'producttype', 'middleware' => ['permission:create-producttype|read-producttype|update-producttype|delete-producttype|menu-producttype']], function () {
                Route::get('', 'ProductTypeController@index')->name('db.master.producttype');
                Route::get('show/{id}', 'ProductTypeController@show')->name('db.master.producttype.show');
                Route::get('create', 'ProductTypeController@create')->name('db.master.producttype.create');
                Route::get('edit/{id}', 'ProductTypeController@edit')->name('db.master.producttype.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-producttype'], 'uses' => 'ProductTypeController@delete'])->name('db.master.producttype.delete');
            });

            Route::group(['prefix' => 'warehouse', 'middleware' => ['permission:create-warehouse|read-warehouse|update-warehouse|delete-warehouse|menu-warehouse']], function () {
                Route::get('', 'WarehouseController@index')->name('db.master.warehouse');
                Route::get('show/{id}', 'WarehouseController@show')->name('db.master.warehouse.show');
                Route::get('create', 'WarehouseController@create')->name('db.master.warehouse.create');
                Route::get('edit/{id}', 'WarehouseController@edit')->name('db.master.warehouse.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-warehouse'], 'uses' => 'WarehouseController@delete'])->name('db.master.warehouse.delete');
            });

            Route::group(['prefix' => 'bank', 'middleware' => ['permission:create-bank|read-bank|update-bank|delete-bank|menu-bank']], function () {
                Route::get('', 'BankController@index')->name('db.master.bank');
                Route::get('show/{id}', 'BankController@show')->name('db.master.bank.show');
                Route::get('create', 'BankController@create')->name('db.master.bank.create');
                Route::get('edit/{id}', 'BankController@edit')->name('db.master.bank.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-bank'], 'uses' => 'BankController@delete'])->name('db.master.bank.delete');
            });

            Route::group(['prefix' => 'truck', 'middleware' => ['permission:create-truck|read-truck|update-truck|delete-truck|menu-truck']], function () {
                Route::get('', 'TruckController@index')->name('db.master.truck');
                Route::get('show/{id}', 'TruckController@show')->name('db.master.truck.show');
                Route::get('create', 'TruckController@create')->name('db.master.truck.create');
                Route::get('edit/{id}', 'TruckController@edit')->name('db.master.truck.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-truck'], 'uses' => 'TruckController@delete'])->name('db.master.truck.delete');
            });

            Route::group(['prefix' => 'vendor', 'middleware' => ['permission:create-vendortrucking|read-vendortrucking|update-vendortrucking|delete-vendortrucking|menu-vendortrucking']], function () {
                Route::get('trucking', 'VendorTruckingController@index')->name('db.master.vendor.trucking');
                Route::get('trucking/show/{id}', 'VendorTruckingController@show')->name('db.master.vendor.trucking.show');
                Route::get('trucking/create', 'VendorTruckingController@create')->name('db.master.vendor.trucking.create');
                Route::get('trucking/edit/{id}', 'VendorTruckingController@edit')->name('db.master.vendor.trucking.edit');
                Route::delete('trucking/edit/{id}', ['middleware' => ['permission:delete-vendortrucking'], 'uses' => 'VendorTruckingController@delete'])->name('db.master.vendor.trucking.delete');
            });

            Route::group(['prefix' => 'expense_template', 'middleware' => ['permission:create-expensetemplate|read-expensetemplate|update-expensetemplate|delete-expensetemplate|menu-expensetemplate']], function () {
                Route::get('', 'ExpenseTemplateController@index')->name('db.master.expense_template');
                Route::get('show/{id}', 'ExpenseTemplateController@show')->name('db.master.expense_template.show');
                Route::get('create', 'ExpenseTemplateController@create')->name('db.master.expense_template.create');
                Route::get('edit/{id}', 'ExpenseTemplateController@edit')->name('db.master.expense_template.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-expensetemplate'], 'uses' => 'ExpenseTemplateController@delete'])->name('db.master.expense_template.delete');
            });
        });

        Route::group(['prefix' => 'admin'], function () {
            Route::group(['prefix' => 'user', 'middleware' => ['permission:create-user|read-user|update-user|delete-user|menu-user']], function () {
                Route::get('', 'UserController@index')->name('db.admin.user');
                Route::get('show/{id}', 'UserController@show')->name('db.admin.user.show');
                Route::get('create', 'UserController@create')->name('db.admin.user.create');
                Route::get('edit/{id}', 'UserController@edit')->name('db.admin.user.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-user'], 'uses' => 'UserController@delete'])->name('db.admin.user.delete');
            });

            Route::group(['prefix' => 'roles', 'middleware' => ['permission:create-role|read-role|update-role|delete-role|menu-role']], function () {
                Route::get('', 'RolesController@index')->name('db.admin.roles');
                Route::get('show/{id}', 'RolesController@show')->name('db.admin.roles.show');
                Route::get('create', 'RolesController@create')->name('db.admin.roles.create');
                Route::get('edit/{id}', 'RolesController@edit')->name('db.admin.roles.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-role'], 'uses' => 'RolesController@delete'])->name('db.admin.roles.delete');
            });

            Route::group(['prefix' => 'store', 'middleware' => ['permission:create-store|read-store|update-store|delete-store|menu-store']], function () {
                Route::get('', 'StoreController@index')->name('db.admin.store');
                Route::get('show/{id}', 'StoreController@show')->name('db.admin.store.show');
                Route::get('create', 'StoreController@create')->name('db.admin.store.create');
                Route::get('edit/{id}', 'StoreController@edit')->name('db.admin.store.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-store'], 'uses' => 'StoreController@delete'])->name('db.admin.store.delete');
            });

            Route::group(['prefix' => 'unit', 'middleware' => ['permission:create-unit|read-unit|update-unit|delete-unit|menu-unit']], function () {
                Route::get('', 'UnitController@index')->name('db.admin.unit');
                Route::get('show/{id}', 'UnitController@show')->name('db.admin.unit.show');
                Route::get('create', 'UnitController@create')->name('db.admin.unit.create');
                Route::get('edit/{id}', 'UnitController@edit')->name('db.admin.unit.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-unit'], 'uses' => 'UnitController@delete'])->name('db.admin.unit.delete');
            });

            Route::group(['prefix' => 'currencies', 'middleware' => ['permission:create-currencies|read-currencies|update-currencies|delete-currencies|menu-currencies']], function(){
                Route::get('', 'CurrenciesController@index')->name('db.admin.currencies');
                Route::get('show/{id}', 'CurrenciesController@show')->name('db.admin.currencies.show');
                Route::get('create', 'CurrenciesController@create')->name('db.admin.currencies.create');
                Route::get('edit/{id}', 'CurrenciesController@edit')->name('db.admin.currencies.edit');
                Route::delete('edit/{id}', ['middleware' => ['permission:delete-currencies'], 'uses' => 'CurrenciesController@delete'])->name('db.admin.currencies.delete');
            });

            Route::group(['prefix' => 'phone', 'middleware' => ['permission:create-phoneprovider|read-phoneprovider|update-phoneprovider|delete-phoneprovider|menu-phoneprovider']], function () {
                Route::get('provider', 'PhoneProviderController@index')->name('db.admin.phone_provider');
                Route::get('provider/show/{id}', 'PhoneProviderController@show')->name('db.admin.phone_provider.show');
                Route::get('provider/create', 'PhoneProviderController@create')->name('db.admin.phone_provider.create');
                Route::get('provider/edit/{id}', 'PhoneProviderController@edit')->name('db.admin.phone_provider.edit');
                Route::delete('provider/edit/{id}', ['middleware' => ['permission:delete-provider'], 'uses' => 'PhoneProviderController@delete'])->name('db.admin.phone_provider.delete');
            });

            Route::group(['prefix' => 'settings'], function () {
                Route::get('', 'SettingsController@index')->name('db.admin.settings');
                Route::post('update', 'SettingsController@update')->name('db.admin.settings.update');
            });
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('profile/{id}', 'UserController@profile')->name('db.user.profile.show');

            Route::get('calendar', 'CalendarController@index')->name('db.user.calendar.show');
            Route::get('calendar/retrieve', 'CalendarController@retrieveEvents')->name('db.user.calendar.retrieve');
            Route::post('calendar/save', 'CalendarController@storeEvent')->name('db.user.calendar.store');
        });

        Route::get('daily_log', ['middleware' => ['role:admin|permission:daily_log'], 'uses' => 'DailyLogController@index'])->name('db.daily_log');

        Route::get('logs', ['middleware' => ['role:admin'], 'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index'])->name('db.logs');

        Route::get('search', 'SearchController@search')->name('db.search');

        Route::get('about', 'DashboardController@contributors')->name('db.contrib');
    });

    Route::get('/home', 'HomeController@index');
});
