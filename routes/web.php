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

// Admin Login Routes

Route::get('admin/login','Admin\LoginController@login')->name('admin.login');
Route::post('admin/login','Admin\LoginController@checkLoginCredentials')->name('admin.loginpost');
// Admin Login Routes End
Route::prefix('admin')->namespace('Admin')->group(function() {
 Route::group(['middleware' => ['admin']], function() {
     // Admin Dashboard Route and Logout
     Route::get('dashboard', 'LoginController@dashboard')->name('admin.dashboard');
     Route::get('logout', 'LoginController@logout')->name('admin.logout');
     // Admin Setting Up Routes.
     Route::get('settings', 'AdminController@settings');
     Route::post('check-current-password', 'AdminController@chkCurrentPwd');
     Route::post('update-password', 'AdminController@updatePassword');
     Route::match(['get','post'],'update-admin-detail','AdminController@adminDetail');
     // Users Route
     Route::get('users','UserController@index')->name('user.list');
     Route::post('update-user-status', 'UserController@updateUserStatus');

     // Sections Route
     Route::get('sections','SectionController@index')->name('section.index');
     Route::get('create-section', 'SectionController@create')->name('section.add');
     Route::post('sections/store', 'SectionController@store')->name('section.store');
     Route::post('update-section-status', 'SectionController@updateStatus');
     // Categories Route
     Route::get('categories', 'CategoryController@index')->name('category.lists');
     Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
     Route::post('change-section-category-appear', 'CategoryController@sectionChangeCategory');
    //  Route::get('create-categories', 'CategoryController@create')->name('category.add');
    //  Route::post('categories/store', 'CategoryController@store')->name('category.store');
    Route::match(['get','post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory')->name('category.add');
 });
});

// Admin Routes End
