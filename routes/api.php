<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'post', 'middleware' => 'auth:api'], function () {
    Route::post('user/set_settings', 'StoreController@applySettings')->name('api.user.apply_settings');
    Route::post('user/notepad/save', 'DashboardController@saveNotepad')->name('api.post.user.notepad.save');

    Route::group(['prefix' => 'dashboard'], function () {
        Route::group(['prefix' => 'daily_log'], function() {
            Route::post('create', 'DailyLogController@store')->name('api.post.db.daily_log.create');
            Route::post('update/{id}', 'DailyLogController@update')->name('api.post.db.daily_log.update');
        });

        Route::group(['prefix' => 'po'], function () {
            Route::post('create', 'PurchaseOrderController@store')->name('api.post.db.po.create');
            Route::post('revise/{id}', 'PurchaseOrderController@saveRevision')->name('api.post.db.po.revise');

            Route::group(['prefix' => 'payment'], function () {
                Route::post('{id}/cash', 'PurchaseOrderPaymentController@saveCashPayment')->name('api.post.db.po.payment.cash');
                Route::post('{id}/transfer', 'PurchaseOrderPaymentController@saveTransferPayment')->name('api.post.db.po.payment.transfer');
                Route::post('{id}/giro', 'PurchaseOrderPaymentController@saveGiroPayment')->name('api.post.db.po.payment.giro');
            });

            Route::group(['prefix' => 'copy'], function () {
                Route::post('{code}/create', 'PurchaseOrderCopyController@store')->name('api.post.db.po.copy.create');
                Route::post('{code}/edit/{id}', 'PurchaseOrderCopyController@update')->name('api.post.db.po.copy.edit');
            });
        });

        Route::group(['prefix' => 'acc'], function() {
            Route::post('create', 'Accounting\CashAccountController@store')->name('api.post.db.acc.cash.create');
            Route::post('edit/{id}', 'Accounting\CashAccountController@update')->name('api.post.db.acc.cash.edit');
        });

        Route::group(['prefix' => 'so'], function () {
            Route::post('create', 'SalesOrderController@store')->name('api.post.db.so.create');
            Route::post('save/draft', 'SalesOrderController@saveDraft')->name('api.post.db.so.create.savedraft');
            Route::post('revise/{id}', 'SalesOrderController@saveRevision')->name('api.post.db.so.revise');

            Route::group(['prefix' => 'payment'], function () {
                Route::post('{id}/cash', 'SalesOrderPaymentController@saveCashPayment')->name('api.post.db.so.payment.cash');
                Route::post('{id}/transfer', 'SalesOrderPaymentController@saveTransferPayment')->name('api.post.db.so.payment.transfer');;
                Route::post('{id}/giro', 'SalesOrderPaymentController@saveGiroPayment')->name('api.post.db.so.payment.giro');;
                Route::post('{id}/bf', 'SalesOrderPaymentController@saveBroughtForwardPayment')->name('api.post.db.so.payment.bf');
            });

            Route::group(['prefix' => 'copy'], function () {
                Route::post('{code}/create', 'SalesOrderCopyController@store')->name('api.post.db.so.copy.create');
                Route::post('{code}/edit/{id}', 'SalesOrderCopyController@update')->name('api.post.db.so.copy.edit');
            });
        });

        Route::group(['prefix' => 'customer'], function () {
            Route::group(['prefix' => 'confirmation'], function() {
                Route::post('confirm/{id}', 'CustomerController@storeConfirmationSalesOrder')->name('api.post.db.customer.confirmation.confirm');
            });
            Route::group(['prefix' => 'payment'], function() {
                Route::post('cash/{id}', 'CustomerController@storePaymentCashCustomer')->name('api.post.db.customer.payment.cash');
                Route::post('transfer/{id}', 'CustomerController@storePaymentTransferCustomer')->name('api.post.db.customer.payment.transfer');
                Route::post('giro/{id}', 'CustomerController@storePaymentGiroCustomer')->name('api.post.db.customer.payment.giro');
            });
        });

        Route::group(['prefix' => 'warehouse'], function () {
            Route::group(['prefix' => 'inflow'], function () {
                Route::post('receipt/{id?}', 'WarehouseInflowController@saveReceipt')->name('api.post.db.warehouse.inflow.receipt');
            });

            Route::group(['prefix' => 'inflow'], function () {
                Route::post('deliver/{id?}', 'WarehouseOutflowController@saveDeliver')->name('api.post.db.warehouse.outflow.deliver');
            });

            Route::group(['prefix' => 'trf/stock'], function() {
                Route::post('transfer', 'WarehouseTransferStockController@saveTransfer')->name('api.post.db.warehouse.transfer_stock.transfer');
            });

            Route::group(['prefix' => 'stock'], function() {
                Route::post('merge', 'StockController@mergeStock')->name('api.post.db.warehouse.merge_stock.create');
            });
        });

        Route::group(['prefix' => 'master'], function () {
            Route::group(['prefix' => 'supplier'], function () {
                Route::post('create', 'SupplierController@store')->name('api.post.db.master.supplier.create');
                Route::post('edit/{id}', 'SupplierController@update')->name('api.post.db.master.supplier.edit');
            });

            Route::group(['prefix' => 'customer'], function () {
                Route::post('create', 'CustomerController@store')->name('api.post.db.master.customer.create');
                Route::post('edit/{id}', 'CustomerController@update')->name('api.post.db.master.customer.edit');
            });

            Route::group(['prefix' => 'product'], function () {
                Route::post('create', 'ProductController@store')->name('api.post.db.master.product.create');
                Route::post('edit/{id}', 'ProductController@update')->name('api.post.db.master.product.edit');
            });

            Route::group(['prefix' => 'warehouse'], function () {
                Route::post('create', 'WarehouseController@store')->name('api.post.db.master.warehouse.create');
                Route::post('edit/{id}', 'WarehouseController@update')->name('api.post.db.master.warehouse.edit');
            });

            Route::group(['prefix' => 'truck'], function() {
                Route::post('create', 'TruckController@store')->name('api.post.db.master.truck.create');
                Route::post('edit/{id}', 'TruckController@update')->name('api.post.db.master.truck.edit');

                Route::group(['prefix' => 'maintenance'], function() {
                    Route::post('create', 'TruckMaintenanceController@store')->name('api.post.db.maintenance.truck.create');
                    Route::post('edit/{id}', 'TruckMaintenanceController@update')->name('api.post.db.maintenance.truck.edit');
                });
            });

            Route::group(['prefix' => 'producttype'], function() {
                Route::post('create', 'ProductTypeController@store')->name('api.post.db.master.producttype.create');
                Route::post('edit/{id}', 'ProductTypeController@update')->name('api.post.db.master.producttype.edit');
            });

            Route::group(['prefix' => 'vendor'], function() {
                Route::post('trucking/create', 'VendorTruckingController@store')->name('api.post.db.master.vendor.trucking.create');
                Route::post('trucking/edit/{id}', 'VendorTruckingController@update')->name('api.post.db.master.vendor.trucking.edit');
            });

            Route::group(['prefix' => 'expense_template'], function() {
                Route::post('create', 'ExpenseTemplateController@store')->name('api.post.db.master.expense_template.create');
                Route::post('edit/{id}', 'ExpenseTemplateController@update')->name('api.post.db.master.expense_template.edit');
            });

            Route::group(['prefix' => 'bank'], function() {
                Route::post('create', 'BankController@store')->name('api.post.db.master.bank.create');
                Route::post('edit/{id}', 'BankController@update')->name('api.post.db.master.bank.edit');
            });
        });

        Route::group(['prefix' => 'bank'], function() {
            Route::group(['prefix' => 'giro'], function() {
                Route::post('create', 'GiroController@store')->name('api.post.db.bank.giro.create');
                Route::post('edit/{id}', 'GiroController@update')->name('api.post.db.bank.giro.edit');
            });
        });

        Route::group(['prefix' => 'admin'], function () {
            Route::group(['prefix' => 'store'], function () {
                Route::post('create', 'StoreController@store')->name('api.post.db.admin.store.create');
                Route::post('edit/{id}', 'StoreController@update')->name('api.post.db.admin.store.edit');
            });

            Route::group(['prefix' => 'unit'], function () {
                Route::post('create', 'UnitController@store')->name('api.post.db.admin.unit.create');
                Route::post('edit/{id}', 'UnitController@update')->name('api.post.db.admin.unit.edit');
            });

            Route::group(['prefix' => 'currencies'], function () {
                Route::post('create', 'CurrenciesController@store')->name('api.post.db.admin.currencies.create');
                Route::post('edit/{id}', 'CurrenciesController@update')->name('api.post.db.admin.currencies.edit');
            });

            Route::group(['prefix' => 'roles'], function () {
                Route::post('create', 'RolesController@store')->name('api.post.db.admin.roles.create');
                Route::post('edit/{id}', 'RolesController@update')->name('api.post.db.admin.roles.edit');
            });

            Route::group(['prefix' => 'user'], function () {
                Route::post('create', 'UserController@store')->name('api.post.db.admin.user.create');
                Route::post('edit/{id}', 'UserController@update')->name('api.post.db.admin.user.edit');
            });

            Route::group(['prefix' => 'phone'], function() {
                Route::post('provider/create', 'PhoneProviderController@store')->name('api.post.db.admin.phone_provider.create');
                Route::post('provider/edit/{id}', 'PhoneProviderController@update')->name('api.post.db.admin.phone_provider.edit');
            });
        });

        Route::group(['prefix' => 'tax'], function() {
            Route::group(['prefix' => 'invoice'], function () {
                Route::group(['prefix' => 'input'], function () {
                    Route::post('create', 'TaxInvoiceInputController@store')->name('api.post.db.tax.invoice.input.create');
                    Route::post('edit/{id}', 'TaxInvoiceInputController@update')->name('api.post.db.tax.invoice.input.edit');
                });

                Route::group(['prefix' => 'output'], function () {
                    Route::post('create', 'TaxInvoiceOutputController@store')->name('api.post.db.tax.invoice.output.create');
                    Route::post('edit/{id}', 'TaxInvoiceOutputController@saveEdit')->name('api.post.db.tax.invoice.output.edit');
                });
            });
        });

        Route::group(['prefix' => 'employee'], function() {
            Route::post('create', 'EmployeeController@store')->name('api.post.db.employee.create');
            Route::post('edit/{id}', 'EmployeeController@update')->name('api.post.db.employee.edit');
        });

        Route::group(['prefix' => 'price'], function() {
            Route::post('category/{id}', 'PriceController@updateCategoryPrice')->name('api.post.db.price.category.update');
            Route::post('stock/{id}', 'PriceController@updateStockPrice')->name('api.post.db.price.stock.update');

            Route::group(['prefix' => 'price_level'], function() {
                Route::post('create', 'PriceLevelController@store')->name('api.post.db.price.level.create');
                Route::post('edit/{id}', 'PriceLevelController@update')->name('api.post.db.price.level.edit');;
            });
        });
    });
});

Route::group(['prefix' => 'get'], function () {
    Route::group(['prefix' => 'warehouse'], function () {
        Route::group(['prefix' => 'outflow'], function () {
            Route::get('so/{id?}', 'WarehouseOutflowController@getWarehouseSOs')->name('api.warehouse.outflow.so');
            Route::get('so/bycode/{code?}', 'WarehouseInflowController@getWarehouseSOByCode')->name('api.warehouse.inflow.so.bycode');
        });
        Route::group(['prefix' => 'inflow'], function () {
            Route::get('po/{id?}', 'WarehouseInflowController@getWarehousePOs')->name('api.warehouse.inflow.po');
            Route::get('po/bycode/{code?}', 'WarehouseInflowController@getWarehousePOByCode')->name('api.warehouse.inflow.po.bycode');
        });
        Route::group(['prefix' => 'stock_opname'], function () {
            Route::get('last', 'WarehouseController@getLastStockOpname')->name('api.warehouse.stock_opname.last');
        });
    });

    Route::group(['prefix' => 'bank'], function () {
        Route::group(['prefix' => 'upload'], function () {
            Route::get('last', 'BankController@getLastBankUpload')->name('api.bank.upload.last');
        });
    });

    Route::group(['prefix' => 'giro'], function () {
        Route::get('due_giro', 'GiroController@getDueGiro')->name('api.giro.due_giro');
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::get('', 'CustomerController@getCustomer')->name('api.get.customer');
        Route::get('search_customer', 'CustomerController@searchCustomers')->name('api.customer.search');
        Route::get('passive_customer', 'CustomerController@getPassiveCustomer')->name('api.customer.passive_customer');
        Route::get('open_sales', 'CustomerController@getOpenSales')->name('api.get.customer.open_sales');
        Route::get('last_sale', 'CustomerController@getLastSale')->name('api.get.customer.last_sale');
    });

    Route::group(['prefix' => 'supplier'], function () {
        Route::get('search_supplier', 'SupplierController@searchSuppliers')->name('api.supplier.search');
    });

    Route::group(['prefix' => 'phone_provider'], function() {
        Route::get('search/{param?}', 'PhoneProviderController@getPhoneProviderByDigit')->name('api.phone_provider.search');
    });

    Route::group(['prefix' => 'po'], function() {
        Route::get('due_purchase_order', 'PurchaseOrderController@getDuePO')->name('api.purchase_order.due_purchase_order');
        Route::get('unreceived_purchase_order', 'PurchaseOrderController@getUnreceivedPO')->name('api.purchase_order.unreceived_purchase_order');
        Route::get('purchase_order_by_date', 'PurchaseOrderController@getPOByDate')->name('api.purchase_order.purchase_order_by_date');
        Route::get('list_po_dates', 'PurchaseOrderController@getListPODates')->name('api.purchase_order.list_po_dates');

        Route::get('code', function () {
            return \App\Util\POCodeGenerator::generateCode();
        })->name('api.get.po.code');
    });

    Route::group(['prefix' => 'so'], function() {
        Route::get('due_sales_order', 'SalesOrderController@getDueSO')->name('api.sales_order.due_sales_order');
        Route::get('undelivered_sales_order', 'SalesOrderController@getUndeliveredSO')->name('api.sales_order.undelivered_sales_order');
        Route::get('number_of_created_sales_order_per_day', 'SalesOrderController@getNumberOfCreatedSOPerDay')->name('api.sales_order.number_of_created_sales_order_per_day');
        Route::get('total_sales_order_amount_per_day', 'SalesOrderController@getTotalSOAmountPerDay')->name('api.sales_order.total_sales_order_amount_per_day');
        Route::get('sale_order_by_date', 'SalesOrderController@getSOByDate')->name('api.sales_order.sales_order_by_date');

        Route::group(['prefix' => 'payment'], function() {
            Route::get('customerList', 'SalesOrderPaymentController@customerList')->name('api.sales_order.payment.customer_list');
        });

        Route::get('code', function () {
            return \App\Util\SOCodeGenerator::generateCode();
        })->name('api.get.so.code');
    });

    Route::group(['prefix' => 'report'], function() {
        Route::group(['prefix' => 'mon'], function() {
            Route::group(['prefix' => 'stockhistory'], function () {
                Route::get('/', 'StockController@stockTypeIndex')->name('api.report.mon.stockhistory.type.index');
            });
        });

        Route::group(['prefix' => 'tax'], function() {
            Route::get('/', 'ReportTaxController@generateTaxReport')->name('api.report.tax');
        });
    });

    Route::group(['prefix' => 'price'], function() {
        Route::get('last_update', 'PriceController@getLastUpdate')->name('api.price.last_update');
    });

    Route::group(['prefix' => 'stock'], function() {
        Route::get('', 'StockController@getStock')->name('api.get.stock');
        Route::get('current_stocks/{wId?}', 'StockController@getCurrentStocks')->name('api.stock.current_stocks');
        Route::get('get/by/product', 'StockController@getStocksByProduct')->name('api.get.stock.byproduct');
    });

    Route::get('user/get/calendar', 'CalendarController@retrieveEvents')->name('api.user.get.calendar');

    Route::get('get/unfinish/store', 'StoreController@isUnfinishedStoreExist')->name('api.get.unfinish.store');

    Route::get('get/unfinish/warehouse', 'WarehouseController@isUnfinishedWarehouseExist')->name('api.get.unfinish.warehouse');

    Route::get('currencies/conversion', 'CurrenciesController@conversion')->name('api.currencies.conversion');
});
