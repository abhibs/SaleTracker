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
                        Route::post('/profile/update', 'adminProfileUpdate')->name('admin-profile-update');


                        // Team Members
                        Route::get('/add/team/member', 'addAdmin')->name('admin-add');
                        Route::post('/add/team/member/post', 'addAdminPost')->name('admin-add-post');
                        Route::get('/all/team/member', 'allAdmin')->name('all-admin');
                        Route::get('/team/member/inactive/{id}', 'inactive')->name('admin-inactive');
                        Route::get('/team/member/active/{id}', 'active')->name('admin-active');
                        Route::get('/team/member/delete/{id}', 'delete')->name('admin-delete');

                    });
                });
            }
        );






