<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Category;
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
//     return view('front.index');
// });

Route::namespace('Front')->group(function(){
    Route::get('/' , 'HomeController@index')->name('home.index');
    /** Login/Registration User */
    Route::get('/login', 'UserLoginController@loginForm');
    // login data send to loginUser() method.
    Route::post('/login', 'UserLoginController@loginUser');
    // registerForm() method display the register form.
    Route::get('/register', 'UserRegistrationController@registerForm');
    // check if email already exists.
    Route::match(['get','post'],'/check-email', 'UserRegistrationController@checkEmail');
    // registerUser() method send user's record to database and confirmation link.
    Route::post('/register', 'UserRegistrationController@registerUser');
    // logoutUser() method to logout user.
    Route::get('/logout','UserLoginController@logoutUser');
    // Email Confirmation Route.
    Route::match(['get','post'],'/confirm/{code}', 'UserRegistrationController@confirmEmail');
    
    /** Login/Registration User End Routes. */
    Route::get('/cart','CartController@cart');
    // To avoid errors make sure this url must be at down.
    Route::get('/{url}','ProductsController@index')->name('product-list.index');
    Route::get('product/{id}', 'ProductsController@show');
    Route::post('/get-product-price', 'ProductsController@productPrice');
    Route::post('/add-to-cart', 'ProductsController@addToCart');
    Route::post('/update-cart-quantity', 'CartController@updateCartQuantity');
    Route::post('/cart-item-delete', 'CartController@deleteCartQuantity');
   
  
    

    // Making Category URL dynamic
//     $categoryUrl = Category::select('url')->pluck('url')->toArray();
//    // echo "<pre>"; print_r($categoryUrl); die();
//    foreach ($categoryUrl as $url) {
//     Route::get('/'.$url,'ProductsController@index')->name('product-list.index');
//    }
    
   
});
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

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
    // Brands Route
    Route::get('brands','BrandController@index')->name('brand.lists');
    Route::match(['get', 'post'], 'add-edit-brand/{id?}', 'BrandController@addEditBrand'); 
    Route::post('update-brand-status', 'BrandController@updateStatus');
    Route::get('delete-brand/{id}', 'BrandController@destroy');
    // Sections Route
    Route::get('sections','SectionController@index')->name('section.index');
    Route::get('create-section', 'SectionController@create')->name('section.add');
    Route::post('sections/store', 'SectionController@store')->name('section.store');
    Route::post('update-section-status', 'SectionController@updateStatus');
    Route::get('delete-section/{id}', 'SectionController@destroy');
    // Categories Route
    Route::get('categories', 'CategoryController@index')->name('category.lists');
    Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
    Route::post('change-section-category-appear', 'CategoryController@sectionChangeCategory');
    //  Route::get('create-categories', 'CategoryController@create')->name('category.add');
    //  Route::post('categories/store', 'CategoryController@store')->name('category.store');
    Route::match(['get','post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory')->name('category.add');
    Route::get('delete-category-image/{id}', 'CategoryController@deleteCategoryImage');
    Route::get('delete-category/{id}', 'CategoryController@deleteCategory');

    // Products Routes
    Route::get('products', 'ProductController@index')->name('product.lists');
    Route::post('update-product-status', 'ProductController@updateProductStatus');
    Route::post('change-section-product-appear', 'ProductController@sectionProductCategory');
    Route::match(['get', 'post'],'add-edit-product/{id?}', 'ProductController@addEditProduct')->name('product.addEdit');
    Route::get('delete-product-image/{id}', 'ProductController@deleteProductImage');
    Route::get('delete-product-video/{id}', 'ProductController@deleteProductVideo');
    Route::get('delete-product/{id}', 'ProductController@deleteProduct');
    // Product Attributes
    Route::match(['get','post'],'add-product-attributes/{id}', 'ProductController@addAttributes');
    Route::post('edit-product-attributes/{id}', 'ProductController@editProductAttributes'); 
    Route::post('update-attribute-status', 'ProductController@updateAttributesStatus');
    Route::get('delete-attribute/{id}', 'ProductController@deleteAttribute');
    // Product Images
    Route::match(['get', 'post'],'add-product-images/{id}', 'ProductController@addImages');
    Route::post('update-image-status', 'ProductController@updateImageStatus');
    Route::get('delete-image/{id}', 'ProductController@deleteImage');

    // Banners Routes
    Route::get('banners', 'BannersController@index')->name('banner.list');
    Route::get('delete-banner/{id}', 'BannersController@deleteBanner'); 
    Route::post('update-banner-status', 'BannersController@updateBannerStatus');
    Route::match(['get','post'],'add-edit-banner/{id?}', 'BannersController@addEditBanner');
 });
});

// Admin Routes End
