<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Modules\Core\Http\ApiControllers',
    'prefix' => 'api/core/order',
    'middleware' => ['api', 'throttle:120,1']
], function () {

    Route::post("/", "Order\OrderController@index")->name('api.core.order.index');

});
