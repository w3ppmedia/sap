<?php


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

header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );

Route::post('business-partner', 'BusinessPartnerController@post');
Route::put('business-partner', 'BusinessPartnerController@put');

Route::post('service-call', 'ServiceCallController@post');
Route::put('service-call/{id}', 'ServiceCallController@put');

Route::post('auth/login', 'AuthController@login');
Route::post('auth/logout', 'AuthController@logout');



