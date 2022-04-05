<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ImportDetailController;
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
//Auth
Route::get('/',[AuthController::class,'show']);
Route::get('/dashboard',[AuthController::class,'show']);
Route::get('/logout',[AuthController::class,'logout']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/recover-pass',[AuthController::class,'recover']);
Route::post('/send-token',[AuthController::class,'send_token']);
Route::post('/reset-pass',[AuthController::class,'reset_pass']);
Route::get('/change-pass',[AuthController::class,'change_pass']);
Route::post('/change-new-pass',[AuthController::class,'change_new_pass']);
Route::get('/profile',[AuthController::class,'profile']);
Route::post('/update-profile',[AuthController::class,'update_profile']);

//User
Route::group(['middleware' => 'admin'], function(){
    Route::get('/view-user',[UserController::class,'index']);
    Route::get('/fetchdata-user',[UserController::class,'fetchdata']);
    Route::post('/create-user',[UserController::class,'create']);
    Route::get('/edit-user/{id}',[UserController::class,'edit']);
    Route::post('/update-user/{id}',[UserController::class,'update']);
    Route::get('/destroy-user/{id}',[UserController::class,'destroy']);
});

Route::group(['middleware' => 'mod'], function(){
    //Supplier
    Route::get('/view-supplier',[SupplierController::class,'index']);
    Route::get('/fetchdata-supplier',[SupplierController::class,'fetchdata']);
    Route::post('/create-supplier',[SupplierController::class,'create']);
    Route::get('/edit-supplier/{id}',[SupplierController::class, 'edit']);
    Route::post('/update-supplier/{id}',[SupplierController::class,'update']);
    Route::get('/destroy-supplier/{id}',[SupplierController::class,'destroy']);

    //Delivery
    Route::get('/load-city',[DeliveryController::class,'load_city']);
    Route::post('/select-delivery',[DeliveryController::class,'select_delivery']);

    //Brand
    Route::get('/view-brand',[BrandController::class,'index']);
    Route::get('/fetchdata-brand',[BrandController::class,'fetchdata']);
    Route::post('/create-brand',[BrandController::class,'create']);
    Route::get('/edit-brand/{id}',[BrandController::class, 'edit']);
    Route::post('/update-brand/{id}',[BrandController::class,'update']);
    Route::get('/destroy-brand/{id}',[BrandController::class,'destroy']);

    //Category
    Route::get('/view-category',[CategoryController::class,'index']);
    Route::get('/fetchdata-category',[CategoryController::class,'fetchdata']);
    Route::post('/create-category',[CategoryController::class,'create']);
    Route::get('/edit-category/{id}',[CategoryController::class, 'edit']);
    Route::post('/update-category/{id}',[CategoryController::class,'update']);
    Route::get('/destroy-category/{id}',[CategoryController::class,'destroy']);

    //Unit
    Route::get('/view-unit',[UnitController::class,'index']);
    Route::get('/fetchdata-unit',[UnitController::class,'fetchdata']);
    Route::post('/create-unit',[UnitController::class,'create']);
    Route::get('/edit-unit/{id}',[UnitController::class, 'edit']);
    Route::post('/update-unit/{id}',[UnitController::class,'update']);
    Route::get('/destroy-unit/{id}',[UnitController::class,'destroy']);

    //Product
    Route::get('/view-product',[ProductController::class,'index']);
    Route::get('/fetchdata-product',[ProductController::class,'fetchdata']);
    Route::post('/create-product',[ProductController::class,'create']);
    Route::get('/edit-product/{id}',[ProductController::class, 'edit']);
    Route::post('/update-product/{id}',[ProductController::class,'update']);
    Route::get('/destroy-product/{id}',[ProductController::class,'destroy']);

    //Import
    Route::get('/view-import',[ImportController::class,'index']);
    Route::get('/fetchdata-import',[ImportController::class,'fetchdata']);
    Route::post('/create-import',[ImportController::class,'create']);
    Route::get('/edit-import/{id}',[ImportController::class, 'edit']);
    Route::post('/update-import/{id}',[ImportController::class,'update']);
    Route::get('/destroy-import/{id}',[ImportController::class,'destroy']);

    //ImportDetail
    Route::get('/view-importdetail/{id}',[ImportDetailController::class,'index']);
    Route::get('/fetchdata-importdetail',[ImportDetailController::class,'fetchdata']);
    Route::post('/create-importdetail',[ImportDetailController::class,'create']);
    Route::get('/edit-importdetail/{id}',[ImportDetailController::class, 'edit']);
    Route::post('/update-importdetail/{id}',[ImportDetailController::class,'update']);
    Route::get('/destroy-importdetail/{id}',[ImportDetailController::class,'destroy']);

    //Coupon
    Route::get('/view-coupon',[CouponController::class,'index']);
    Route::get('/fetchdata-coupon',[CouponController::class,'fetchdata']);
    Route::post('/create-coupon',[CouponController::class,'create']);
    Route::get('/edit-coupon/{id}',[CouponController::class, 'edit']);
    Route::post('/status-coupon/{id}',[CouponController::class,'status']);
    Route::post('/update-coupon/{id}',[CouponController::class,'update']);
    Route::get('/destroy-coupon/{id}',[CouponController::class,'destroy']);
});
//Customer
Route::get('/view-customer',[CustomerController::class,'index']);
Route::get('/fetchdata-customer',[CustomerController::class,'fetchdata']);
Route::post('/create-customer',[CustomerController::class,'create']);
Route::get('/edit-customer/{id}',[CustomerController::class, 'edit']);
Route::post('/update-customer/{id}',[CustomerController::class,'update']);
Route::get('/destroy-customer/{id}',[CustomerController::class,'destroy']);
