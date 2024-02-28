<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(["prefix" => '/{any}'], function () {
    $request = app('request');
    $base = new \App\Services\Base\BaseControllers($request);
    // $request->merge($base->getMergeRequest());
    Route::any('/', $base->index($request))->where('any', '.*');
});
// Route::get('/{any}', [\App\Http\Controllers\BaseControllers::class, 'index'])->where('any', '.*');
// Route::post('/{any}', [\App\Http\Controllers\BaseControllers::class, 'index'])->where('any', '.*');
// Route::delete('/{any}', [\App\Http\Controllers\BaseControllers::class, 'index'])->where('any', '.*');
