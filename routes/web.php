<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/user-registration',function(){
    return view('dashboard.user_registration');
});

Route::get('/inventory',function(){
    return view('dashboard.dashboard');
});

Route::get('/item-category',function(){
    return view('dashboard.item_category');
});

Route::get('/item',function(){
    return view('dashboard.item');
});

Route::get('/supplier',function(){
    return view('dashboard.supplier');
});

Route::get('/purchase-order',function(){
    return view('dashboard.purchase_order_requests');
});

Route::get('/test',function(){
    return view('dashboard.test');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
