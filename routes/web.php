<?php

use App\Http\Controllers\ExpenseController;
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


Route::group(['middleware' => ['auth'], 'prefix' => 'user'],function (){
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.list');
    Route::get('/expenses/add', [ExpenseController::class, 'add'])->name('expenses.add');
    Route::post('/expenses/save', [ExpenseController::class, 'store'])->name('expenses.save');
    Route::get('/expenses/view/{expense}', [ExpenseController::class, 'view'])->name('expenses.view');
    Route::post('/expenses/view/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::get('/expenses/delete/{expense}', [ExpenseController::class, 'delete'])->name('expenses.delete');
});
