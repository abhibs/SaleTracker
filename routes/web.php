<?php

use App\Http\Controllers\UserController;
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





Route::get('', [UserController::class, 'userLogin'])->name('login');
Route::get('register', [UserController::class, 'userRegister'])->name('register');
Route::post('register', [UserController::class, 'userRegisterPost'])->name('user-register-post');;
Route::post('login', [UserController::class, 'userLoginPost'])->name('user-login-post');
Route::group(
    ['middleware' => 'auth:web'],
    function () {
        Route::get('dashboard', [UserController::class, 'userDashboard'])->name('user-dashboard');
        Route::post('sales/post', [UserController::class, 'salesPost'])->name('sale-post');
    }
);
