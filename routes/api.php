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


Route::get('/login', function () {
    return view('index');
});
Route::post('/sign-in', function () {
    return ['Login'];
});
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'PassportController@login');
    Route::post('register', 'PassportController@register');
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'PassportController@logout');
        Route::post('edit', 'PassportController@edit');
        Route::post('bid', 'api\BidController@submitBid');
    });
});
Route::get('/landing', 'api\ItemController@landing');
Route::get('/myBids/{user}', 'api\BidController@myBids');
