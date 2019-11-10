<?php

use Illuminate\Http\Request;

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

Route::get('/landing', function () {
    return view('welcome');
});
// Route::get('/', function () {
//     return view('home');
// });
// Route::get('/welcome', function () {
//     return view('welcome');
// });
Route::get('/', function(Request $request) {

    $query = http_build_query([
        'client_id' => 12,
        'redirect_uri' => 'http://pink-croc-auction.test/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    
    return redirect('/oauth/authorize?'.$query);
});

Route::get('/callback', function(Request $request) {

    $http = new GuzzleHttp\Client;

    $response = $http->post('/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 12,
            'client_secret' => '0SecNkqNQWgDew1COi0LRQyOm42iwv6I2BurCjUr',
            'redirect_uri' => 'http://pink-croc-auction.test/callback',
            'code' => 'def50200b1a30eb0781d74a9addd5ededb9907316c375a1fa1882763e02554b2ce14a8011ed188d8e6231f49fa8bdc99f3ad47e195c770e018c59514bab16bc0fd4bc2654aa7f466a91938f361bcda0544325d0aba36045d6a2cd4d9cbde5aee468780f6515473c1b6e0da12662e3335a8aa26f51195034bc3259613886054d659520af72c741b2b47a3f2616fce9f17914057adf44340fda5663fa82ea8746cf48435d14b6662d7337d62a34ba8b27ec81fee762ccb1188e147ac305dd0b767de41950aea1e2899653ba8d54bd3598ca44947791ba69c71e5ef57a0cec77a746e193cac0ad76dd118928684d6d5b31d3ab612121bdb9b8d6dc6c3d975f03c4583d10173f0f1149b733896a76f29ab31113baddac5e20577ee2296a0a0745d96eeed853b11aeb5ced5c832d8f304d34dcc8f45e25bdb9b3e126b86c6ef606cfeb2cf72b9289397b5264d30cea7147b7124bdaf2aa4d9b59340881a52d13505d5cc107747875e5d5b'
        ]
    ]);

    // $response = $http->post('/oauth/token', [
    //     'form_params' => [
    //         'grant_type' => 'password',
    //         'client_id' => 'client-id',
    //         'client_secret' => 'B45U9pCF4MOk64Z6mEpzlt6nnpa6xcc5fkWdGbYE',
    //         'username' => 'Fiona@email.com',
    //         'password' => '$2y$10$ugduT7B6s.o.AkiBCnf22eMiE98OT7HUhVtmqTqERbHQL5DwTOCtq',
    //         'scope' => '',
    //     ],
    // ]);
            
    return json_decode((string) $response->getBody(), true);
    // return 'Callback';
});
        
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'HomeController@admin')->name('admin')->middleware('admin');

Route::resource('/doner', 'DonerController')->middleware('admin');
Route::resource('/item', 'ItemController')->middleware('admin');
Route::get('/item/orderby/{order}', 'ItemController@index')->middleware('admin');
Route::resource('/event', 'EventController')->middleware('admin');



Route::get('/log', 'AdminController@logs')->middleware('admin');
Route::get('/{id}/log', 'AdminController@log_show')->middleware('admin');

// Route::get('oauth/clients');
Route::view('/{path?}', 'index');



