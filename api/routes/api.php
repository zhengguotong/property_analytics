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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//create new Property
Route::post('properties', 'PropertyController@store')->name('property.store');
Route::get('properties/{property}/analytics', 'PropertyController@analytics')->name('property.analytics');
Route::post('properties/{property}/analytics', 'PropertyController@createOrUpdateAnalytic');
Route::get('properties/analytics/search', 'PropertyAnalyticController@search')->name('property.analytics.search');;
