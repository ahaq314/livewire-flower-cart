<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MyOrdersController;
use App\Http\Controllers\ThankYouController;
use App\Http\Controllers\Auth\LoginController;

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



Auth::routes();

//-------------------------User section------------------------------------
Route::name('user.')->group(function(){
  
    Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
         Route::get('/', ProductController::class)->name('product.list');
         Route::get('/cart', CartController::class)->name('cart.list');

    });

    Route::middleware(['auth:web','PreventBackHistory'])->group(function(){
             Route::view('/home', 'home')->name('home');
             Route::get('/checkout', CheckoutController::class)->name('cart.checkout');
             Route::get('myorders', MyOrdersController::class)->name('myorders');
             Route::get('thankyou', ThankYouController::class)->name('thankyou');
             Route::get('logout', [LoginController::class,'logout']);
    });

});

//--------------------- Admin section----------------------------------

Route::prefix('admin')->name('admin.')->group(function(){
       
    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
            Route::get('login', [LoginController::class,'showAdminLoginForm'])->name('login');
            Route::post('login', [LoginController::class,'adminLogin'])->name('login.action');

    });



    Route::middleware(['auth:admin','PreventBackHistory'])->namespace('App\Http\Controllers\Admin')->group(function(){
            Route::get('/', 'DashboardController@index') -> name('home');
            Route::get('/product/create', 'ProductController@create') -> name('product.create');
            Route::post('/mark-as-read', 'DashboardController@markNotification')->name('markNotification');
            Route::resource('product', ProductController::class);
    });

});




