<?php

namespace App\Providers;

use App\Services\Implementation\CustomerServiceImpl;
use App\Services\Implementation\GiroServiceImpl;
use App\Services\Implementation\InflowServiceImpl;
use App\Services\Implementation\PaymentServiceImpl;
use App\Services\Implementation\ProductServiceImpl;
use App\Services\Implementation\PurchaseOrderCopyServiceImpl;
use App\Services\Implementation\PurchaseOrderServiceImpl;
use App\Services\Implementation\ReportServiceImpl;
use App\Services\Implementation\SalesOrderCopyServiceImpl;
use App\Services\Implementation\SalesOrderServiceImpl;
use App\Services\Implementation\SettingServiceImpl;
use App\Services\Implementation\StockServiceImpl;
use App\Services\Implementation\StoreServiceImpl;
use App\Services\Implementation\SupplierServiceImpl;
use App\Services\Implementation\TaxInvoiceInputServiceImpl;
use App\Services\Implementation\TaxInvoiceOutputServiceImpl;
use App\Services\Implementation\VendorTruckingServiceImpl;
use App\Services\Implementation\WarehouseServiceImpl;
use App\Services\Implementation\DatabaseServiceImpl;
use App\Services\Implementation\AccountingServiceImpl;
use App\Services\Implementation\StockTransferServiceImpl;

use App\Services\CustomerService;
use App\Services\GiroService;
use App\Services\InflowService;
use App\Services\PaymentService;
use App\Services\ProductService;
use App\Services\PurchaseOrderCopyService;
use App\Services\PurchaseOrderService;
use App\Services\ReportService;
use App\Services\SalesOrderCopyService;
use App\Services\SalesOrderService;
use App\Services\SettingService;
use App\Services\StockService;
use App\Services\StoreService;
use App\Services\SupplierService;
use App\Services\TaxInvoiceInputService;
use App\Services\TaxInvoiceOutputService;
use App\Services\VendorTruckingService;
use App\Services\WarehouseService;
use App\Services\DatabaseService;
use App\Services\AccountingService;
use App\Services\StockTransferService;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CustomerService::class, function (){
            return new CustomerServiceImpl();
        });

        $this->app->singleton(GiroService::class, function (){
            return new GiroServiceImpl();
        });

        $this->app->singleton(InflowService::class, function (){
            return new InflowServiceImpl();
        });

        $this->app->singleton(PaymentService::class, function (){
            return new PaymentServiceImpl();
        });

        $this->app->singleton(ProductService::class, function (){
            return new ProductServiceImpl();
        });

        $this->app->singleton(PurchaseOrderCopyService::class, function (){
            return new PurchaseOrderCopyServiceImpl();
        });

        $this->app->singleton(PurchaseOrderService::class, function (){
            return new PurchaseOrderServiceImpl();
        });

        $this->app->singleton(ReportService::class, function (){
            return new ReportServiceImpl();
        });

        $this->app->singleton(SalesOrderCopyService::class, function (){
            return new SalesOrderCopyServiceImpl();
        });

        $this->app->singleton(SalesOrderService::class, function (){
            return new SalesOrderServiceImpl($this->app->make('App\Services\PaymentService'));
        });

        $this->app->singleton(StockService::class, function (){
            return new StockServiceImpl();
        });

        $this->app->singleton(StoreService::class, function (){
            return new StoreServiceImpl();
        });

        $this->app->singleton(SupplierService::class, function (){
            return new SupplierServiceImpl();
        });

        $this->app->singleton(VendorTruckingService::class, function (){
            return new VendorTruckingServiceImpl();
        });

        $this->app->singleton(WarehouseService::class, function (){
            return new WarehouseServiceImpl();
        });

        $this->app->singleton(SettingService::class, function (){
            return new SettingServiceImpl();
        });

        $this->app->singleton(DatabaseService::class, function (){
            return new DatabaseServiceImpl();
        });

        $this->app->singleton(AccountingService::class, function (){
            return new AccountingServiceImpl();
        });

        $this->app->singleton(StockTransferService::class, function (){
            return new StockTransferServiceImpl();
        });

        $this->app->singleton(TaxInvoiceOutputService::class, function (){
            return new TaxInvoiceOutputServiceImpl();
        });

        $this->app->singleton(TaxInvoiceInputService::class, function (){
            return new TaxInvoiceInputServiceImpl();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'App\Services\CustomerService',
            'App\Services\GiroService',
            'App\Services\InflowService',
            'App\Services\PaymentService',
            'App\Services\ProductService',
            'App\Services\PurchaseOrderCopyService',
            'App\Services\PurchaseOrderService',
            'App\Services\ReportService',
            'App\Services\SalesOrderCopyService',
            'App\Services\SalesOrderService',
            'App\Services\StockService',
            'App\Services\StoreService',
            'App\Services\SupplierService',
            'App\Services\VendorTruckingService',
            'App\Services\WarehouseService',
            'App\Services\SettingService',
            'App\Services\DatabaseService',
            'App\Services\AccountingService',
            'App\Services\StockTransferService',
            'App\Services\TaxInvoiceOutputService',
            'App\Services\TaxInvoiceInputService',
        ];
    }
}
