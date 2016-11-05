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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/po/code', function (){
    return \App\Util\POCodeGenerator::generatePOCode();
})->name('api.po.code');

Route::get('/so/code', function (){
    return \App\Util\SOCodeGenerator::generateSOCode();
})->name('api.so.code');

Route::group(['prefix' => 'warehouse'], function ()
{
    Route::group(['prefix' => 'outflow'], function ()
    {
        Route::get('/so/{id?}', 'WarehouseOutflowController@getWarehouseSOs')->name('api.warehouse.outflow.so');
    });

    Route::group(['prefix' => 'inflow'], function ()
    {
        Route::get('/po/{id?}', 'WarehouseInflowController@getWarehousePOs')->name('api.warehouse.inflow.po');
    });
});

Route::group(['prefix' => 'search'], function ()
{
    Route::get('customers', 'CustomerController@searchCustomers')->name('api.search.customers');
});
