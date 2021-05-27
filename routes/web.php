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

Route::get('/users',[UserController::class,'index'])->middleware(['auth','permitted']);
Route::post('/users/enroll',[UserController::class,'enrollorupdate']);
Route::get('/users/get/table',[UserController::class,'get']);
Route::get('/users/find/{id}',[UserController::class,'find']);
Route::get('/users/edit/status/{id}/{status}',[UserController::class,'editStatus']);

Route::get('/permissions',[PermissionController::class,'index'])->middleware(['auth','permitted']);
Route::post('/permissions/enroll',[PermissionController::class,'enrollorupdate'])->middleware(['auth']);
Route::get('/permissions/get/table',[PermissionController::class,'get'])->middleware(['auth']);
Route::get('/permissions/edit/status/{id}/{status}',[PermissionController::class,'editStatus'])->middleware(['auth']);
Route::get('/permissions/find/{id}',[PermissionController::class,'find']);

Route::get('/vehicles',[VehicleController::class,'index'])->middleware(['auth','permitted']);
Route::post('/vehicles/enroll',[VehicleController::class,'enrollorupdate']);
Route::get('/vehicles/get/table',[VehicleController::class,'get']);
Route::get('/vehicles/find/{id}',[VehicleController::class,'find']);
Route::get('/vehicles/edit/status/{id}/{status}',[VehicleController::class,'editStatus']);
Route::get('/vehicles/next/data/{vid}',[VehicleController::class,'nextIdwithVehicleCode']);

Route::get('/products',[ProductController::class,'index'])->middleware(['auth','permitted']);
Route::get('/products/suggesions',[ProductController::class,'suggetions']);
Route::post('/products/enroll',[ProductController::class,'enrollorupdate']);
Route::get('/products/get/table',[ProductController::class,'get']);
Route::get('/products/find/{id}',[ProductController::class,'find']);
Route::get('/products/edit/status/{id}/{status}',[ProductController::class,'editStatus']);

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
