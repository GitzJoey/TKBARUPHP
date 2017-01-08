<?php

namespace App\Providers;

use App\Http\Controllers\PurchaseOrderPaymentController;

use App\Services\Implementation\InflowServiceImpl;
use App\Services\Implementation\PaymentServiceImpl;
use App\Services\Implementation\PurchaseOrderCopyServiceImpl;
use App\Services\Implementation\PurchaseOrderServiceImpl;
use App\Services\Implementation\SalesOrderCopyServiceImpl;
use App\Services\Implementation\SalesOrderServiceImpl;
use App\Services\Implementation\StockServiceImpl;
use App\Services\Implementation\StoreServiceImpl;
use App\Services\Implementation\SupplierServiceImpl;
use App\Services\Implementation\ReportServiceImpl;

use App\Services\InflowService;
use App\Services\PaymentService;
use App\Services\PurchaseOrderCopyService;
use App\Services\PurchaseOrderService;
use App\Services\SalesOrderCopyService;
use App\Services\SalesOrderService;
use App\Services\StockService;
use App\Services\SupplierService;
use App\Services\StoreService;
use App\Services\ReportService;

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
        $this->app->singleton(PurchaseOrderService::class, function (){
            return new PurchaseOrderServiceImpl();
        });

        $this->app->singleton(SalesOrderService::class, function (){
            return new SalesOrderServiceImpl();
        });

        $this->app->singleton(StockService::class, function (){
            return new StockServiceImpl();
        });

        $this->app->singleton(SupplierService::class, function (){
            return new SupplierServiceImpl();
        });

        $this->app->singleton(InflowService::class, function (){
            return new InflowServiceImpl();
        });

        $this->app->singleton(PurchaseOrderCopyService::class, function (){
            return new PurchaseOrderCopyServiceImpl();
        });

        $this->app->singleton(SalesOrderCopyService::class, function (){
            return new SalesOrderCopyServiceImpl();
        });

        $this->app->singleton(StoreService::class, function (){
            return new StoreServiceImpl();
        });

        $this->app->singleton(ReportService::class, function (){
            return new ReportServiceImpl();
        });

        $this->app->singleton(PaymentService::class, function (){
            return new PaymentServiceImpl();
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
            'App\Services\PurchaseOrderService',
            'App\Services\SalesOrderService',
            'App\Services\StockService',
            'App\Services\SupplierService',
            'App\Services\InflowService',
            'App\Services\PaymentService',
            'App\Services\PurchaseOrderCopyService',
            'App\Services\SalesOrderCopyService',
            'App\Services\StoreService',
            'App\Services\ReportService',
        ];
    }
}
