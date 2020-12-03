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

Route::name("api.")->namespace('API')->group(function () {
    Route::post('/login', 'AuthController@login');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/user', 'UserController@profile');
        Route::post('/user', 'UserController@updateProfile');
        Route::post('/analysis', 'UserController@syncData');
        
        
        Route::get('/chats', 'ChatController@index');
        Route::post('/chats', 'ChatController@send');
    });
});
