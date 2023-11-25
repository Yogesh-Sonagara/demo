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
        });
    });
});
