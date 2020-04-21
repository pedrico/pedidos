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
