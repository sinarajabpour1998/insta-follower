<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Modules\Core\Http\Controllers',
    'prefix' => 'core',
    'middleware' => ['web']
], function () {


});
