<?php

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');;

Auth::routes(['register' => false]);

Route::get('products/{id}/galery', [App\Http\Controllers\ProductController::class, 'galery'])->name('products.galery');
Route::resource('products', App\Http\Controllers\ProductController::class);

Route::resource('product-galeries', App\Http\Controllers\ProductGaleryController::class);

Route::get('transactions/{id}/set-status', [App\Http\Controllers\TransactionController::class, 'setStatus'])->name('transactions.status');
Route::resource('transactions', App\Http\Controllers\TransactionController::class);

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
