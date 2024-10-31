<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VariantController;
use App\Http\Controllers\Backend\VerifyEmailController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* Backend routes */
Route::get('/dashboard/index', [DashboardController::class, 'index'])
    ->name('dashboard.index')
    ->middleware('admin');
Route::get('/login', [AuthController::class, 'index'])
    ->name('auth.login')
    ->middleware('login');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.register.post');
Route::get('/verify-email/{token}', [VerifyEmailController::class, 'verify'])->name('auth.verify-email');
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

/* USER */
Route::group(['prefix' => 'user'], function () {
    Route::get('/index', [UserController::class, 'index'])->name('user.index')
        ->middleware('admin');
    Route::get('/create', [UserController::class, 'create'])->name('user.create')
        ->middleware('admin');
    Route::post('/store', [UserController::class, 'store'])->name('user.store')
        ->middleware('admin');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit')
        ->middleware('admin');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update')
        ->middleware('admin');
    Route::get('/show/{id}', [UserController::class, 'show'])->name('user.show')
        ->middleware('admin');
    Route::get('/index-delete', [UserController::class, 'indexSoftDelete'])->name('user.indexSoftDelete')
        ->middleware('admin');
    Route::post('/restore/{id}', [UserController::class, 'restore'])->name('user.restore')
        ->middleware('admin');
    Route::delete('/force-delete/{id}', [UserController::class, 'forceDelete'])->name('user.forceDelete')->middleware('admin');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('user.delete')->middleware('admin');
    Route::get('districts/{province_code}', [UserController::class, 'getDistricts'])->name('getDistricts')->middleware('admin');
    Route::get('wards/{district_code}', [UserController::class, 'getWards'])->name('getWards')->middleware('admin');
});

/*Role */
Route::group(['prefix' => 'role'], function () {
    Route::get('/index', [RoleController::class, 'index'])->name('role.index')
        ->middleware('admin');
    Route::get('/create', [RoleController::class, 'create'])->name('role.create')
        ->middleware('admin');
    Route::post('/store', [RoleController::class, 'store'])->name('role.store')
        ->middleware('admin');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')
        ->middleware('admin');
    Route::put('/update/{id}', [RoleController::class, 'update'])->name('role.update')
        ->middleware('admin');
    Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete')
        ->middleware('admin');
});

/*Category*/
Route::group(['prefix' => 'category', 'middleware' => 'admin'], function () {
    Route::get('/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
});

/*Product */
Route::group(['prefix' => 'product', 'middleware' => 'admin'], function () {
    Route::get('/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/index-delete', [ProductController::class, 'indexSoftDelete'])->name('product.indexSoftDelete');
    Route::post('/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
    Route::delete('/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('product.forceDelete');
    Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
});

/*Variant */
Route::group(['prefix' => 'variant', 'middleware' => 'admin'], function () {
    Route::get('/index', [VariantController::class, 'index'])->name('variant.index');
    Route::get('/create', [VariantController::class, 'create'])->name('variant.create');
    Route::post('/store', [VariantController::class, 'store'])->name('variant.store');
    Route::delete('variant/color/{id}', [VariantController::class, 'deleteColor'])->name('variant.delete.color');
    Route::delete('variant/size/{id}', [VariantController::class, 'deleteSize'])->name('variant.delete.size');
});

/*Coupon */
Route::group(['prefix' => 'coupon', 'middleware' => 'admin'], function () {
    Route::get('/index', [CouponController::class, 'index'])->name('coupon.index');
    Route::get('/create', [CouponController::class, 'create'])->name('coupon.create');
    Route::post('/store', [CouponController::class, 'store'])->name('coupon.store');
    Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit');
    Route::put('/update/{id}', [CouponController::class, 'update'])->name('coupon.update');
    Route::delete('/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.delete');
});

/*Coupon */
Route::group(['prefix' => 'order', 'middleware' => 'admin'], function () {
    Route::get('/index', [OrderController::class, 'index'])->name('order.index');
    Route::post('/orders/update-status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::delete('/delete/{id}', [OrderController::class, 'destroy'])->name('order.delete');
});
