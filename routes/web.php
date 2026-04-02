<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;  

use App\Http\Controllers\ShopController;

Route::get('/admin/profile', [ShopController::class, 'profile'])->name('shop.profile');
Route::post('/admin/profile', [ShopController::class, 'updateProfile'])->name('shop.profile.update');
Route::middleware('auth')->group(function () {
    Route::get('/biodata', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/biodata', [ShopController::class, 'store'])->name('shop.store');
});

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/admin', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/transactions', [TransactionController::class, 'index'])
        ->name('admin.transactions');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');



Route::get('/admin/products', [ProductController::class, 'index'])
    ->name('admin.products');

Route::get('/admin/products/create', [ProductController::class, 'create'])
    ->name('admin.products.create');

Route::post('/admin/products', [ProductController::class, 'store'])
    ->name('admin.products.store');

    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])
    ->name('admin.products.edit');

Route::put('/admin/products/update/{id}', [ProductController::class, 'update'])
    ->name('admin.products.update');

Route::delete('/admin/products/delete/{id}', [ProductController::class, 'delete'])
    ->name('admin.products.delete');

Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/admin/orders/update/{id}', [OrderController::class, 'update'])->name('orders.update');
});

require __DIR__.'/auth.php';