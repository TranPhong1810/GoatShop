<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
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
