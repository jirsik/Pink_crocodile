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


// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', function () {
    return view('index');
});
// Route::get('/', function(Request $request) {

//     $query = http_build_query([
//         'client_id' => 11,
//         'redirect_uri' => 'http://www.pink-croc-auction.test/callback',
//         'response_type' => 'code',
//         'scope' => '',
//     ]);
    
//     // var_dump(redirect('/oauth/authorize?'.$query));
    
//     return redirect('/oauth/authorize?'.$query);
// });

Route::get('/callback', function(Request $request) {

    $http = new GuzzleHttp\Client;

    // $response = $http->post('http://www.pink-croc-auction.test/oauth/token', [
    //     'form_params' => [
    //         'grant_type' => 'authorization_code',
    //         'client_id' => 12,
    //         'client_secret' => '0SecNkqNQWgDew1COi0LRQyOm42iwv6I2BurCjUr',
    //         'redirect_uri' => 'http://www.pink-croc-auction.test/callback',
    //         'code' => $request->code
    //     ]
    // ]);

    $response = $http->post('http://www.pink-croc-auction.test/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => 12,
            'client_secret' => '0SecNkqNQWgDew1COi0LRQyOm42iwv6I2BurCjUr',
            'username' => 'Fiona@email.com',
            'password' => '$2y$10$ugduT7B6s.o.AkiBCnf22eMiE98OT7HUhVtmqTqERbHQL5DwTOCtq',
            'scope' => '',
        ],
    ]);
            
    return json_decode((string) $response->getBody(), true);
});
        
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'HomeController@admin')->name('admin')->middleware('admin');

Route::resource('/doner', 'DonerController')->middleware('admin');
Route::resource('/item', 'ItemController')->middleware('admin');
Route::resource('/event', 'EventController')->middleware('admin');

Route::resource('/auction/item', 'AuctionController')->middleware('admin');

Route::get('/log', 'AdminController@logs')->middleware('admin');
Route::get('/{id}/log', 'AdminController@log_show')->middleware('admin');
Route::get('/finished/evets', 'AdminController@finished_events')->middleware('admin');
Route::get('/finished/evets/{id}', 'AdminController@finished_event_info')->middleware('admin');




//image placeholder
Route::get('/uploads/doners/{file}', function() {
    return response( file_get_contents('./uploads/doners/doner.png') )
        ->header('Content-Type','image/png');
});
Route::get('/uploads/items/{file}', function() {
    return response( file_get_contents('./uploads/items/item.png') )
        ->header('Content-Type','image/png');
});

//mails
Route::get('/mail/winner', 'AuctionController@check_for_ending');


Route::get('api/landing', 'api\ItemController@landing');

