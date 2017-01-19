<?php

namespace App\Providers;

use App\Http\Controllers\PurchaseOrderPaymentController;

use App\Services\Implementation\CustomerServiceImpl;
use App\Services\Implementation\InflowServiceImpl;
use App\Services\Implementation\PaymentServiceImpl;
use App\Services\Implementation\ProductServiceImpl;
use App\Services\Implementation\PurchaseOrderCopyServiceImpl;
use App\Services\Implementation\PurchaseOrderServiceImpl;
use App\Services\Implementation\ReportServiceImpl;
use App\Services\Implementation\SalesOrderCopyServiceImpl;
use App\Services\Implementation\SalesOrderServiceImpl;
use App\Services\Implementation\StockServiceImpl;
use App\Services\Implementation\StoreServiceImpl;
use App\Services\Implementation\SupplierServiceImpl;
use App\Services\Implementation\VendorTruckingServiceImpl;
use App\Services\Implementation\WarehouseServiceImpl;

use App\Services\CustomerService;
use App\Services\InflowService;
use App\Services\PaymentService;
use App\Services\ProductService;
use App\Services\PurchaseOrderCopyService;
use App\Services\PurchaseOrderService;
use App\Services\ReportService;
use App\Services\SalesOrderCopyService;
use App\Services\SalesOrderService;
use App\Services\StockService;
use App\Services\StoreService;
use App\Services\SupplierService;
use App\Services\VendorTruckingService;
use App\Services\WarehouseService;


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
            return new SalesOrderServiceImpl();
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
            'App\Services\WarehouseService'
        ];
    }
}
