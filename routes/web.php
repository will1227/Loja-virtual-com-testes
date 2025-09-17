<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\SuppliersController;
use App\Models\Suppliers;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');


    Route::get('/products/new', [ProductsController::class, 'create']);
    Route::post('/products/new', [ProductsController::class, 'store']);
    Route::get('/products', [ProductsController::class, 'index'])->name('products');
    Route::get('/products/update/{id}', [ProductsController::class, 'edit']);
    Route::post('/products/update/', [ProductsController::class, 'update']);
    Route::get('/products/delete/{id}', [ProductsController::class, 'destroy']);
    
    
    Route::get('/types/new', [TypesController::class, 'create']);
    Route::post('/types/new', [TypesController::class, 'store']);
    Route::get('/types', [TypesController::class, 'index'])->name('types');
    Route::get('/types/update/{id}', [TypesController::class, 'edit']);
    Route::post('/types/update/', [TypesController::class, 'update']);
    Route::get('/types/delete/{id}', [TypesController::class, 'destroy']);

    Route::get('/suppliers/new', [SuppliersController::class, 'create']);
    Route::post('/suppliers/new', [SuppliersController::class, 'store']);
    Route::get('/suppliers', [SuppliersController::class, 'index'])->name('suppliers');
    Route::get('/suppliers/update/{id}', [SuppliersController::class, 'edit']);
    Route::post('/suppliers/update/{id}', [SuppliersController::class, 'update']);
    Route::delete('/suppliers/delete/{id}', [SuppliersController::class, 'destroy']);

});
require __DIR__ . '/auth.php';
