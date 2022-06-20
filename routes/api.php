<?php

use App\Http\Controllers\Welcome\WelcomeController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register',[
    'uses' =>'Api\AuthController@register',
    'as' => 'api.register'
]);
Route::post('/login',[
    'uses' =>'Api\AuthController@login',
    'as' => 'api.login'
]);
Route::get('/me',[
    'uses' =>'Api\AuthController@me',
    'as' => 'api.me'
])->middleware('auth:api');

