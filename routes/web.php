<?php

use App\Http\Controllers\Admin\AdminController;
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

Route::prefix('admin')->group(function () {
    // admin login route
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login'])->name('admin.login');
    Route::group(['middleware' => ['admin']], function () {
        Route::controller(AdminController::class)->group(function () {
            // admin dashboard route
            Route::get('dashboard', 'dashboard')->name('admin.dashboard');
            // update admin password
            Route::match(['get', 'post'], 'update-admin-password', 'updateAdminPassword')->name('admin.update_password');
            // check admin password
            Route::post('check-current-password', 'checkCurrentPassword')->name('admin.check_current_password');
            // update admin details
            Route::match(['get', 'post'], 'update-admin-details', 'updateAdminDetails')->name('admin.update_details');
            // admin logout route
            Route::get('logout', 'logout')->name('admin.logout');
        });
    });
});
