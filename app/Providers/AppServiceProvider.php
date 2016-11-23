<?php

namespace App\Providers;

use App\Services\Implementation\PurchaseOrderServiceImpl;
use App\Services\Implementation\SalesOrderServiceImpl;
use App\Services\Implementation\StockServiceImpl;
use App\Services\PurchaseOrderService;
use App\Services\SalesOrderService;
use App\Services\StockService;
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
            'App\Services\StockService'
        ];
    }
}
