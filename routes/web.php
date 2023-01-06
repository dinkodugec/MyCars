<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('starting_page');
});

Route::get('/info', function () {
    return view('info');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('car', CarController::class);

Route::resource('tag', TagController::class);

Route::resource('user', UserController::class);

Route::get('/car/tag/{tag_id}', 'CarTagController@getFilterdCars')->name('car_tag');

// Attach / Detach Tags to Car
Route::get('/car/{car_id}/tag/{tag_id}/attach', 'CarTagController@attachTag');
Route::get('/car/{car_id}/tag/{tag_id}/detach', 'CarTagController@detachTag');

//DELETE
Route::get('/delete-car/car/{car_id}', 'CarController@deleteImages');
