<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(["prefix" => '/{any}'], function () {
    $request = app('request');
    $base = new \App\Http\Controllers\BaseControllers($request);
    Route::any('/', $base->index($request))->where('any', '.*');
});

// Route::group(["prefix" => '/{any}'], function () {
//     Route::any('/', function (Request $request) {
//         $base = new \App\Http\Controllers\BaseControllers($request);
//         return $base->index($request);
//     })->where('any', '.*');
// });
