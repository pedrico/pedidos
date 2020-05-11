<?php

use App\Mail\Welcome;
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
    return view('welcome');
});

Auth::routes();
Route::get('email', function(){
    $user = new App\User(['name' => 'Pedro']);
    return new Welcome($user);
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('pruebasCSS', 'PruebasCSSController@show');
Route::get('pruebasCSS_register', 'PruebasCSSController@register');
Route::resource('dashboard', 'DashboardController');
Route::resource('users', 'UserController');
Route::get('landing', 'Customer\ProductController@products')->name('landing');

Route::resource('profile', 'Customer\ProfileController');
Route::resource('address', 'Customer\AddressController');
Route::resource('phone', 'Customer\PhoneController');
Route::get('map/{lat}/{long}', 'Customer\ProfileController@map');

Route::resource('product_category', 'Product\CategoryController');
Route::put('product_category/{id}/{status}','Product\CategoryController@status');
Route::post('movil/login', 'Movil\AuthController@login');

Route::post('profile_image', 'Customer\ProfileController@profile_image')->name('profile_image');
Route::post('category_image', 'Product\CategoryController@image')->name('category_image');
Route::post('category_update_image', 'Product\CategoryController@update_image')->name('category_update_image');




