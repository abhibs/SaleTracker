<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/test', function () {
    echo "Abhiram";
});


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});
Route::get('migrate', function () {
    Artisan::call('migrate');
    return "Migrate Completed!";
});
Route::get('optimize', function () {
    Artisan::call('optimize');
    return "optimized!";
});


Route::group(
    ['prefix' => 'admin'],
    function () {
        Route::controller(AdminController::class)->group(
            function () {
                Route::get('/login', 'login')->name('admin-login');
                Route::post('/login/post', 'loginPost')->name('admin-login-post');
                    Route::group(['middleware' => 'auth:admin'], function () {
                        Route::get('/dashboard', 'dashboard')->name('admin-dashboard');
                        Route::get('/logout',  'adminLogout')->name('admin-logout');
                        Route::get('/change/password', 'adminChangePassword')->name('admin-change-password');
                        Route::post('/change/password/post', 'adminChangePasswordPost')->name('admin-change-password-post');
                        Route::get('/profile', 'adminProfile')->name('admin-profile');

                    });
                });
            }
        );






