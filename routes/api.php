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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/product/{prod}', 'ApiController@singleProductApi');
Route::get('/productmodal/{product}', 'ApiController@productmodal');

Route::get('/postcode/initiate', 'ApiController@postcodeInit');
Route::get('/postcode/check/{chkcode}', 'ApiController@postcodeCheck');