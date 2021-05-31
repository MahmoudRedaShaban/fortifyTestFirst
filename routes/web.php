<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminResetPasswordcontroller;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::view('/home', 'home')->middleware('auth');
Route::post('/logoutuser', [AdminController::class,'logoutUser'])->middleware('auth')->name('logout.user');


Route::prefix('admin')->group(function () {
    Route::view('/index', 'admin')->middleware('auth:admin')->name('admin.index');
    Route::get('/login',[AdminLoginController::class,'login_show'])->name('admin.login');
    Route::post('/login',[AdminLoginController::class,'login'])->name('admin.login');
    Route::post('/logout',[AdminController::class,'distroy'])->name('admin.logout')->middleware('auth:admin');
    // Password reser routes
    Route::post('/password/email',[AdminForgotPasswordcontroller::class,'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('/password/reset',[AdminForgotPasswordcontroller::class,'showLinkRequestForm'])->name('admin.password.request');
    //reset
    Route::post('/password/reset',[AdminResetPasswordcontroller::class,'reset']);
    Route::post('/password/reset/{token}',[AdminResetPasswordcontroller::class,'showResetForm'])->name('admin.password.reset');

});
