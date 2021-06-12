<?php

use App\Http\Controllers\BinLocationController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\GRNController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MaterialRequestController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
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

Route::get('/item/category',[ItemCategoryController::class,'index'])->middleware(['auth','permitted']);
Route::post('/item/category/store',[ItemCategoryController::class,'store'])->middleware('auth');
Route::post('/item/category/deactivate',[ItemCategoryController::class,'deactivate'])->name('item/category.deactivate')->middleware('auth');
Route::post('/item/category/activate',[ItemCategoryController::class,'activate'])->name('item/category.activate')->middleware('auth');

Route::get('/item',[ItemController::class,'index'])->middleware(['auth','permitted']);
Route::post('/item/store',[ItemController::class,'store'])->middleware('auth');
Route::post('/item/deactivate',[ItemController::class,'deactivate'])->name('item.deactivate')->middleware('auth');
Route::post('/item/activate',[ItemController::class,'activate'])->name('item.activate')->middleware('auth');

Route::get('/supplier',[SupplierController::class,'index'])->middleware(['auth','permitted']);
Route::post('/supplier/store',[SupplierController::class,'store'])->middleware('auth');
Route::post('/supplier/deactivate',[SupplierController::class,'deactivate'])->name('supplier.deactivate')->middleware('auth');
Route::post('/supplier/activate',[SupplierController::class,'activate'])->name('supplier.activate')->middleware('auth');

Route::get('/po',[PurchaseOrderController::class,'index'])->middleware(['auth','permitted']);
Route::get('/po/loadsupplier',[PurchaseOrderController::class,'loadSupplier'])->name('po.loadsupplier')->middleware('auth');
Route::get('/po/binLocation',[PurchaseOrderController::class,'loadBinLocation'])->name('po.loadbinlocation')->middleware('auth');
Route::get('/po/loaditem',[PurchaseOrderController::class,'loadItem'])->name('po.loaditem')->middleware('auth');
Route::get('/po/sessionAdd',[PurchaseOrderController::class,'sessionAdd'])->name('po.sessionAdd')->middleware('auth');
Route::get('/po/sessionPOItemRemove',[PurchaseOrderController::class,'sessionPOItemRemove'])->name('po.sessionPOItemRemove')->middleware('auth');
Route::get('/po/sessionPOClear',[PurchaseOrderController::class,'sessionPOClear'])->name('po.sessionPOClear')->middleware('auth');
Route::get('/po/sessionPOItemCheck',[PurchaseOrderController::class,'sessionPOItemCheck'])->name('po.sessionPOItemCheck')->middleware('auth');
Route::get('/po/savePO',[PurchaseOrderController::class,'savePO'])->name('po.savePO')->middleware('auth');
Route::get('/po/table',[PurchaseOrderController::class,'tableView'])->middleware('auth');
Route::get('/po/table_view',[PurchaseOrderController::class,'poItemSavedData'])->middleware('auth');
Route::get('/po/viewPO',[PurchaseOrderController::class,'viewPO'])->name('po.viewPO')->middleware('auth');
Route::get('/po/viewPOItems',[PurchaseOrderController::class,'ViewPOItems'])->name('po.viewPOItems')->middleware('auth');
Route::get('/po/updateSelectedPoFromDb',[PurchaseOrderController::class,'UpdateSelectedPoFromDb'])->name('po.updateSelectedPoFromDb')->middleware('auth');
Route::get('/po/calculateSessionTotal',[PurchaseOrderController::class,'CalculateSessionTotal'])->name('po.calculateSessionTotal')->middleware('auth');
Route::get('/po/calculateDbTotal',[PurchaseOrderController::class,'calculateDbTotal'])->name('po.calculateDbTotal')->middleware('auth');
Route::post('/po/updatePo',[PurchaseOrderController::class,'updatePo'])->name('po.updatePo')->middleware('auth');
Route::post('/po/approvePo',[PurchaseOrderController::class,'approvePo'])->name('po.approvePo')->middleware('auth');
Route::post('/po/refusePo',[PurchaseOrderController::class,'refusePo'])->name('po.refusePo')->middleware('auth');
Route::get('/po/counts',[PurchaseOrderController::class,'counts'])->name('po.counts')->middleware('auth');
Route::get('/po/changeStatusPoItemFromDb',[PurchaseOrderController::class,'ChangeStatusPoItemFromDb'])->name('po.changeStatusPoItemFromDb')->middleware('auth');
Route::get('/po/printReport',[PurchaseOrderController::class,'printReport'])->name('po.report');


//BAT

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
Route::get('/vehicles/nextId',[VehicleController::class,'nextId']);
Route::get('/vehicles/get/suggetions',[VehicleController::class,'suggetions']);

Route::get('/products',[ProductController::class,'index'])->middleware(['auth','permitted']);
Route::get('/products/suggesions',[ProductController::class,'suggetions']);
Route::post('/products/enroll',[ProductController::class,'enrollorupdate']);
Route::get('/products/get/table',[ProductController::class,'get']);
Route::get('/products/find/{id}',[ProductController::class,'find']);
Route::get('/products/edit/status/{id}/{status}',[ProductController::class,'editStatus']);

Route::get('/grn',[GRNController::class,'index'])->middleware(['auth','permitted']);
Route::get('/grn/items/suggesions',[ProductController::class,'suggetions']);
Route::post('/grn/enroll',[ProductController::class,'enrollorupdate']);
// Route::get('/products/get/table',[ProductController::class,'get']);
// Route::get('/products/find/{id}',[ProductController::class,'find']);
// Route::get('/products/edit/status/{id}/{status}',[ProductController::class,'editStatus']);

Route::get('/locations/get',[LocationController::class,'getLocations']);
Route::get('/binlocations/get/{lid}',[BinLocationController::class,'getLocationBinLocations']);
Route::get('/binlocations/get/suggetions/{lid}',[BinLocationController::class,'getLocationBinLocationSuggetions']);
Route::get('/items/get/suggetions',[ItemController::class,'getItemSuggetions']);
Route::get('/purchaseorders/find/code',[GRNController::class,'getPOByCode']);

Route::post('/grn/enroll',[GRNController::class,'enroll']);
Route::get('/grn/get/table',[GRNController::class,'tableView']);
Route::get('/grn/session/update/{index}/{qty}',[GRNController::class,'updateRecordSesion']);
Route::get('/grn/session/remove/{index}',[GRNController::class,'removeRecordSesion']);
Route::get('/grn/session/clear',[GRNController::class,'clearGRNSession']);
Route::get('/grn/data/get/table',[GRNController::class,'getAllData']);
Route::get('/grn/view/{id}',[GRNController::class,'getGRNView']);
Route::get('/grn/code/get/all',[GRNController::class,'suggetions']);
Route::get('/grn/get/print/{id}',[GRNController::class,'printReport']);

Route::get('/stocks',[StockController::class,'index'])->middleware(['auth','permitted']);
Route::get('/stocks/get/table/{itemid}/{grnid}/{from}/{to}/{bin}/{locationid}/{isChecked}',[StockController::class,'tableView']);
Route::get('/stocks/print/report/{itemid}/{grnid}/{from}/{to}/{bin}/{locationid}/{isChecked}',[StockController::class,'printReport']);

Route::get('/job',[JobController::class,'index'])->middleware(['auth','permitted']);
Route::get('//job/table/get',[JobController::class,'getAll'])->middleware(['auth']);
Route::get('/job/create',[JobController::class,'create'])->middleware(['auth']);
Route::get('/job/next/code',[JobController::class,'next'])->middleware(['auth']);
Route::get('/job/session/table/get',[JobController::class,'sessionTable'])->middleware(['auth']);
Route::get('/job/session/add',[JobController::class,'sessionAdd'])->middleware(['auth']);
Route::get('/job/session/clear',[JobController::class,'clearSession'])->middleware(['auth']);
Route::get('/job/session/remove/{index}',[JobController::class,'removeFromSession'])->middleware(['auth']);
Route::get('/job/session/get/{index}',[JobController::class,'getFromSession'])->middleware(['auth']);
Route::get('/job/session/load/{id}',[JobController::class,'show']);
Route::get('/job/approve/{id}',[JobController::class,'approve']);
Route::get('/job/refused/{id}',[JobController::class,'refused']);
Route::get('/job/statistics',[JobController::class,'recordsStatistics']);
Route::get('/products/suggesions/{vid}',[ProductController::class,'suggetionsVehicle'])->middleware(['auth']);
Route::get('/job/get/print/{id}',[JobController::class,'printJob'])->middleware(['auth']);

Route::get('/transfer',[TransferController::class,'index'])->middleware(['auth','permitted']);
Route::get('/transfer/item/suggessions/{from}',[TransferController::class,'itemSuggetions'])->middleware(['auth','permitted']);

//BAT

Route::get('/mr',[MaterialRequestController::class,'index'])->middleware(['auth','permitted']);
Route::get('/mr/init',[MaterialRequestController::class,'init'])->middleware('auth');
Route::get('/mr/loaditem',[MaterialRequestController::class,'loadItem'])->middleware('auth');
Route::get('/mr/loadProduct',[MaterialRequestController::class,'loadProduct'])->middleware('auth');
Route::get('/mr/itemSaveSession',[MaterialRequestController::class,'itemSaveSession'])->middleware('auth');
Route::get('/mr/productItemSessionClear',[MaterialRequestController::class,'productItemSessionClear'])->middleware('auth');
Route::get('/mr/materialsTableView',[MaterialRequestController::class,'materialsTableView'])->middleware('auth');
Route::get('/mr/removeItemFromSession',[MaterialRequestController::class,'removeItemFromSession'])->middleware('auth');
Route::get('/mr/saveMaterialRequest',[MaterialRequestController::class,'saveMaterialRequest'])->middleware('auth');
Route::get('/mr/getProductsOfJobByJobId/{id}',[MaterialRequestController::class,'getProductsOfJobByJobId'])->middleware('auth');


// Route::get('/mr',function(){
//     return view('dashboard.material_request');
// });

Route::get('/jobreport',function(){
    return view('dashboard.components.purchase_order_report');
});


Route::get('/vehicle_model',function(){
    return view('dashboard.vehicle_model');
});

Route::get('/product',function(){
    return view('dashboard.product');
});



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
