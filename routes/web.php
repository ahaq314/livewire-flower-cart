<?php

use Illuminate\Support\Facades\Route;
use  Gloudemans\Shoppingcart\Facades\Cart as Cart2;

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
})->name('product.list');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



    Route::get('/login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm');

    Route::post('/login/admin', 'App\Http\Controllers\Auth\LoginController@adminLogin');
  

    Route::view('/home', 'home')->middleware('auth');
  
    Route::group(['as' => 'admin.','prefix'=>'admin','namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'auth:admin'], function () {
    
            Route::get('/', 'DashboardController@index') -> name('dashboard');
           // Route::get('/product/create', 'ProductController@create') -> name('product.create');
            Route::resource('product', ProductController::class);

});

    Route::get('logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);


Route::view('/cart', 'cart')->name('cart.list');

Route::get('/checkout', function(){

    if (Cart2::count()  == 0  ){

        return redirect() -> route('product.list');
    }
    return view('checkout');

})->name('cart.checkout')->middleware('auth');

Route::get('thankyou', function(){

    return view('thankyou');

})->name('thankyou')->middleware('auth');

Route::get('myorders', function(){

    return view('myorders');

})->name('myorders')->middleware('auth');


