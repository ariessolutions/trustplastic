<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\BinLocationController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home',function(){
    return view('dashboard.dashboard');
})->middleware('auth');

Route::get('/item/category',[ItemCategoryController::class,'index'])->middleware('auth');
Route::post('/item/category/store',[ItemCategoryController::class,'store'])->middleware('auth');
Route::post('/item/category/deactivate',[ItemCategoryController::class,'deactivate'])->name('item/category.deactivate')->middleware('auth');
Route::post('/item/category/activate',[ItemCategoryController::class,'activate'])->name('item/category.activate')->middleware('auth');

Route::get('/item',[ItemController::class,'index'])->middleware('auth');
Route::post('/item/store',[ItemController::class,'store'])->middleware('auth');
Route::post('/item/deactivate',[ItemController::class,'deactivate'])->name('item.deactivate')->middleware('auth');
Route::post('/item/activate',[ItemController::class,'activate'])->name('item.activate')->middleware('auth');

Route::get('/supplier',[SupplierController::class,'index'])->middleware('auth');
Route::post('/supplier/store',[SupplierController::class,'store'])->middleware('auth');
Route::post('/supplier/deactivate',[SupplierController::class,'deactivate'])->name('supplier.deactivate')->middleware('auth');
Route::post('/supplier/activate',[SupplierController::class,'activate'])->name('supplier.activate')->middleware('auth');

Route::get('/po',[PurchaseOrderController::class,'index'])->middleware('auth');
Route::get('/po/loadsupplier',[PurchaseOrderController::class,'loadSupplier'])->name('po.loadsupplier')->middleware('auth');
Route::get('/po/binLocation',[PurchaseOrderController::class,'loadBinLocation'])->name('po.loadbinlocation')->middleware('auth');
Route::get('/po/loaditem',[PurchaseOrderController::class,'loadItem'])->name('po.loaditem')->middleware('auth');
Route::get('/po/sessionAdd',[PurchaseOrderController::class,'sessionAdd'])->name('po.sessionAdd')->middleware('auth');
Route::get('/po/sessionPOItemRemove',[PurchaseOrderController::class,'sessionPOItemRemove'])->name('po.sessionPOItemRemove')->middleware('auth');
Route::get('/po/sessionPOClear',[PurchaseOrderController::class,'sessionPOClear'])->name('po.sessionPOClear')->middleware('auth');
Route::get('/po/sessionPOItemCheck',[PurchaseOrderController::class,'sessionPOItemCheck'])->name('po.sessionPOItemCheck')->middleware('auth');
Route::post('/po/savePO',[PurchaseOrderController::class,'savePO'])->name('po.savePO')->middleware('auth');

Route::get('/grn',function(){
    return view('dashboard.grn');
});

Route::get('/vehicle_model',function(){
    return view('dashboard.vehicle_model');
});

Route::get('/product',function(){
    return view('dashboard.product');
});



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
