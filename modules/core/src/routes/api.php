<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TokenValidator;

Route::group([
    'namespace' => 'Modules\Core\Http\ApiControllers',
    'prefix' => 'api/core/order',
    'middleware' => ['api', 'throttle:120,1', TokenValidator::class]
], function () {

    Route::get("/", "Order\OrderController@index")->name('api.core.order.index');
    Route::post("/create", "Order\OrderController@create")->name('api.core.order.create');

});

Route::group([
    'namespace' => 'Modules\Core\Http\ApiControllers',
    'prefix' => 'api/core/follow',
    'middleware' => ['api', 'throttle:120,1', TokenValidator::class]
], function () {

    Route::get("/", "Follow\FollowController@index")->name('api.core.follow.index');
    Route::post("/create", "Follow\FollowController@create")->name('api.core.follow.create');

});
