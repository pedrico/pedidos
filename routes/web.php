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

Route::get('/', 'Customer\LandingController@landing');

Auth::routes();
Route::get('email', function () {
    $user = new App\User(['name' => 'Pedro']);
    return new Welcome($user);
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('pruebasCSS', 'PruebasCSSController@show');
Route::get('pruebasCSS_register', 'PruebasCSSController@register');
Route::resource('dashboard', 'DashboardController');
Route::resource('users', 'UserController');
Route::put('user/assign_role/{userId}', 'UserController@assign_role')->name('user.assign_role');
// Route::get('landing', 'Customer\ProductController@products')->name('landing');
Route::get('landing', 'Customer\LandingController@landing')->name('landing');
Route::get('landing_products/{id}', 'Customer\LandingController@landing_products')->name('landing_products');
Route::post('add_cart_product', 'Customer\LandingController@add_cart_product')->name('add_cart_product');
Route::get('checkout', 'Customer\LandingController@checkout')->name('checkout');

Route::resource('profile', 'Customer\ProfileController');
Route::post('profile_image', 'Customer\ProfileController@profile_image')->name('profile_image');
Route::resource('address', 'Customer\AddressController');
Route::resource('phone', 'Customer\PhoneController');
Route::get('map/{lat}/{long}', 'Customer\ProfileController@map');

Route::resource('product_category', 'Product\CategoryController');
Route::put('product_category/{id}/{status}', 'Product\CategoryController@status');
Route::post('category_image', 'Product\CategoryController@image')->name('category_image');
Route::post('category_update_image', 'Product\CategoryController@update_image')->name('category_update_image');

Route::resource('base', 'BaseController');
Route::put('base/{id}/{status}', 'BaseController@status');

Route::resource('base_driver', 'BaseDriverController');
Route::get('base_assignment/{userId}', 'BaseDriverController@base_assignment')->name('base_assignment');
Route::post('base_assignment/assign/{userId}/{baseId}/{action}', 'BaseDriverController@base_assign')->name('base_assign');

Route::resource('product', 'Product\ProductController');
Route::put('product/{id}/{status}', 'Product\ProductController@status');
Route::post('product_image', 'Product\ProductController@image')->name('product_image');
Route::post('product_update_image', 'Product\ProductController@update_image')->name('product_update_image');
Route::get('product_category_assignment/{productId}', 'Product\ProductController@product_category_assignment')->name('product_category_assignment');
Route::post('product_category_assignment/assign/{productId}/{categoryId}/{action}', 'Product\ProductController@product_category_assign')->name('product_category_assign');

//Apis movil
Route::post('movil/login', 'Movil\AuthController@login');
Route::post('movil/bases', 'Movil\DriverBaseController@bases');
Route::post('movil/driver_base/order_assignment', 'Movil\DriverBaseController@order_assignment');
Route::post('movil/driver_base/orders', 'Movil\DriverBaseController@orders');
Route::post('movil/driver_base/driver_base_orders', 'Movil\DriverBaseController@driver_base_orders');
Route::post('movil/driver_base/base_moto_assign', 'Movil\DriverBaseController@base_moto_assign');
Route::post('movil/driver_base/base_moto_list', 'Movil\DriverBaseController@base_moto_list');

Route::post('movil/driver_moto/order_assignment', 'Movil\DriverMotoController@order_assignment');
Route::post('movil/driver_moto/orders', 'Movil\DriverMotoController@orders');
Route::get('movil/driver_moto/movimientos_arqui2', 'Movil\DriverMotoController@movimientos_arqui2');
Route::get('movil/driver_moto/movimientos_arqui2/pagina', 'Movil\DriverMotoController@movimientos_arqui2_pagina');
