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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('tool/email', 'Api\ToolController@email');
Route::post('tool/sms', 'Api\ToolController@sms');
Route::post('tool/image', 'Api\ToolController@image');
Route::get('tool/property/{id}', 'Api\ToolController@property');
