<?php

use App\Http\Controllers\InsuranceController;
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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
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
Route::get('/login',[AuthController::class,'show']);
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
    Route::get('/user',[UserController::class,'index']);
    Route::get('/fetchdata-user',[UserController::class,'fetchdata']);
    Route::post('/create-user',[UserController::class,'create']);
    Route::get('/edit-user/{id}',[UserController::class,'edit']);
    Route::post('/update-user/{id}',[UserController::class,'update']);
    Route::get('/destroy-user/{id}',[UserController::class,'destroy']);
});

Route::group(['middleware' => 'mod'], function(){
    //Supplier
    Route::get('/supplier',[SupplierController::class,'index']);
    Route::get('/fetchdata-supplier',[SupplierController::class,'fetchdata']);
    Route::post('/create-supplier',[SupplierController::class,'create']);
    Route::get('/edit-supplier/{id}',[SupplierController::class, 'edit']);
    Route::post('/update-supplier/{id}',[SupplierController::class,'update']);
    Route::get('/destroy-supplier/{id}',[SupplierController::class,'destroy']);

    //Delivery
    Route::get('/load-city',[DeliveryController::class,'load_city']);
    Route::post('/select-delivery',[DeliveryController::class,'select_delivery']);

    //Brand
    Route::get('/brand',[BrandController::class,'index']);
    Route::get('/fetchdata-brand',[BrandController::class,'fetchdata']);
    Route::post('/create-brand',[BrandController::class,'create']);
    Route::get('/edit-brand/{id}',[BrandController::class, 'edit']);
    Route::post('/update-brand/{id}',[BrandController::class,'update']);
    Route::get('/destroy-brand/{id}',[BrandController::class,'destroy']);

    //Category
    Route::get('/category',[CategoryController::class,'index']);
    Route::get('/fetchdata-category',[CategoryController::class,'fetchdata']);
    Route::post('/create-category',[CategoryController::class,'create']);
    Route::get('/edit-category/{id}',[CategoryController::class, 'edit']);
    Route::post('/update-category/{id}',[CategoryController::class,'update']);
    Route::get('/destroy-category/{id}',[CategoryController::class,'destroy']);

    //Unit
    Route::get('/unit',[UnitController::class,'index']);
    Route::get('/fetchdata-unit',[UnitController::class,'fetchdata']);
    Route::post('/create-unit',[UnitController::class,'create']);
    Route::get('/edit-unit/{id}',[UnitController::class, 'edit']);
    Route::post('/update-unit/{id}',[UnitController::class,'update']);
    Route::get('/destroy-unit/{id}',[UnitController::class,'destroy']);

    //Product
    Route::post('/create-product',[ProductController::class,'create']);
    Route::get('/edit-product/{id}',[ProductController::class, 'edit']);
    Route::post('/update-product/{id}',[ProductController::class,'update']);
    Route::get('/destroy-product/{id}',[ProductController::class,'destroy']);

    //Import
    Route::get('/import',[ImportController::class,'index']);
    Route::get('/fetchdata-import',[ImportController::class,'fetchdata']);
    Route::post('/create-import',[ImportController::class,'create']);
    Route::get('/edit-import/{id}',[ImportController::class, 'edit']);
    Route::post('/update-import/{id}',[ImportController::class,'update']);
    Route::get('/destroy-import/{id}',[ImportController::class,'destroy']);
    Route::get('/print-import/{id}',[ImportController::class,'print']);

    //ImportDetail
    Route::get('/fetchdata-importdetail/{id}',[ImportDetailController::class,'fetchdata']);
    Route::post('/create-importdetail/{id}',[ImportDetailController::class,'create']);
    Route::get('/edit-importdetail/{id}',[ImportDetailController::class, 'edit']);
    Route::post('/update-importdetail/{id}',[ImportDetailController::class,'update']);
    Route::get('/destroy-importdetail/{id}',[ImportDetailController::class,'destroy']);

    //Coupon
    Route::get('/coupon',[CouponController::class,'index']);
    Route::get('/fetchdata-coupon',[CouponController::class,'fetchdata']);
    Route::post('/create-coupon',[CouponController::class,'create']);
    Route::get('/edit-coupon/{id}',[CouponController::class, 'edit']);
    Route::post('/status-coupon/{id}',[CouponController::class,'status']);
    Route::post('/update-coupon/{id}',[CouponController::class,'update']);
    Route::get('/destroy-coupon/{id}',[CouponController::class,'destroy']);
    Route::post('/autocomplete-coupon',[CouponController::class,'autocomplete']);
    Route::post('/use-coupon',[CouponController::class,'use']);

    //Insurance
    Route::get('/insurance',[InsuranceController::class,'index']);
    Route::get('/fetchdata-insurance',[InsuranceController::class,'fetchdata']);
    Route::post('/create-insurance',[InsuranceController::class,'create']);
    Route::get('/edit-insurance/{id}',[InsuranceController::class, 'edit']);
    Route::post('/update-insurance/{id}',[InsuranceController::class,'update']);
    Route::get('/destroy-insurance/{id}',[InsuranceController::class,'destroy']);
});
//Product
Route::get('/product',[ProductController::class,'index']);
Route::get('/fetchdata-product',[ProductController::class,'fetchdata']);
Route::post('/load-product',[ProductController::class,'load']);
Route::get('/load-productdetail/{id}',[ProductController::class,'load_detail']);
Route::post('/autocomplete-product',[ProductController::class,'autocomplete']);

//Customer
Route::get('/customer',[CustomerController::class,'index']);
Route::get('/fetchdata-customer',[CustomerController::class,'fetchdata']);
Route::post('/create-customer',[CustomerController::class,'create']);
Route::get('/edit-customer/{id}',[CustomerController::class, 'edit']);
Route::post('/update-customer/{id}',[CustomerController::class,'update']);
Route::get('/destroy-customer/{id}',[CustomerController::class,'destroy']);
Route::post('/autocomplete-customer',[CustomerController::class,'autocomplete']);

//Order
Route::get('/order',[OrderController::class,'index']);
Route::get('/fetchdata-order',[OrderController::class,'fetchdata']);
Route::post('/create-order',[OrderController::class,'create']);
Route::get('/edit-order/{id}',[OrderController::class, 'edit']);
Route::post('/update-order/{id}',[OrderController::class,'update']);
Route::get('/destroy-order/{id}',[OrderController::class,'destroy']);

Route::post('/add-cart',[OrderController::class,'add_cart']);
Route::post('/load-cart',[OrderController::class,'load_cart']);
Route::get('/edit-cart/{id}',[OrderController::class,'edit_cart']);
Route::post('/update-cart',[OrderController::class,'update_cart']);
Route::post('/destroy-cart',[OrderController::class,'destroy_cart']);
Route::post('/feeship',[OrderController::class,'feeship']);
Route::post('/autocomplete-order',[OrderController::class,'autocomplete']);

//OrderDetail
Route::get('/fetchdata-orderdetail/{id}',[OrderDetailController::class,'fetchdata']);
Route::post('/create-orderdetail/{id}',[OrderDetailController::class,'create']);
Route::get('/edit-orderdetail/{id}',[OrderDetailController::class, 'edit']);
Route::post('/update-orderdetail/{id}',[OrderDetailController::class,'update']);
Route::get('/destroy-orderdetail/{id}',[OrderDetailController::class,'destroy']);
