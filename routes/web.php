<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Models\Product;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
//login and logout && register Routes
Auth::routes();

//home route
Route::get('/', [HomeController::class, 'index'])->name('home');
//acctive user account routes
Route::get('/activate/{code}', [ActivationController::class, 'activateUserAccount'])->name('user.activate');
Route::get('/resend/{email}', [ActivationController::class, 'resendActivationCode'])->name('code.resend');
//products routes
Route::resource("/products", ProductController::class);
Route::get('/products/category/{category}', [HomeController::class, 'getProdcutByCategory'])->name('category.products');
Route::get('/products/show/{product}', [ProductController::class, 'show'])->name('products.show');
//cart routes
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/add/cart/{product}', 'CartController@addProductToCart')->name('add.cart');
Route::delete('/remove/cart/{product}', 'CartController@removeProductFromCart')->name('remove.cart');
Route::put('/update//cart/{product}', 'CartController@updateProductOnCart')->name('update.cart');
//payment routes
Route::get('/handle-payment', 'PaypalPaymentController@handlePayment')->name('make.payment');
Route::get('/cancel-payment', 'PaypalPaymentController@paymentCancel')->name('cancel.payment');
Route::get('/payment-success', 'PaypalPaymentController@paymentSuccess')->name('success.payment');
//admin routes
Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::get('/admin/login', 'AdminController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'AdminController@adminLogin')->name('admin.login');
Route::get('/admin/logout', 'AdminController@adminLogout')->name('admin.logout');
Route::get('/admin/products', 'AdminController@getProducts')->name('admin.products');
Route::get('/admin/orders', 'AdminController@getOrders')->name('admin.orders');
//orders routes
Route::resource('orders', 'OrderController');
