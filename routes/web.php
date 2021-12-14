<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/home', 'HomeController@index')->name('home');

// Admin Routes

Route::get('admin/login','Admin\LoginController@login')->name('admin.login');
Route::post('admin/login','Admin\LoginController@checkLoginCredentials')->name('admin.loginpost');

Route::prefix('admin')->namespace('Admin')->group(function() {
 Route::group(['middleware' => ['admin']], function() {
     Route::get('dashboard', 'LoginController@dashboard')->name('admin.dashboard');
     Route::get('logout', 'LoginController@logout')->name('admin.logout');

     // Users Route
     Route::get('users','UserController@index')->name('user.list');
 });
});

// Admin Routes End
