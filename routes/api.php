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

Route::get('/', function () {
    return json_encode('API AppMax V1.0.0');
});

Route::post('product', 'ProductController@store');
Route::post('product-operation', 'ProductController@operation');
Route::get('history', 'HistoryController@index');