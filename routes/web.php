<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;

Route::get("/product", [ProductController::class, "index"])->name('product.index');
Route::get("/product/create", [ProductController::class, "create"])->name('product.create');
Route::post("/product", [ProductController::class, "store"])->name('product.store');
Route::get('/product/{id}', [ProductController::class, "show"])->name('product.show');
Route::get("/product/{id}/edit", [ProductController::class, "edit"])->name('product.edit');
Route::patch("/product/{id}", [ProductController::class, "update"])->name('product.update');
Route::delete("/product/{id}", [ProductController::class, "destroy"])->name('product.destroy');

//Route::resource('/product', ProductController::class );

Route::get("/staff", [StaffController::class, "index"])->name('staff.index');
Route::get("/staff/create", [StaffController::class, "create"])->name('staff.create');
Route::post("/staff", [StaffController::class, "store"])->name('staff.store');
Route::get('/staff/{id}', [StaffController::class, "show"])->name('staff.show');
Route::get("/staff/{id}/edit", [StaffController::class, "edit"])->name('staff.edit');
Route::patch("/staff/{id}", [StaffController::class, "update"])->name('staff.update');
Route::delete("/staff/{id}", [StaffController::class, "destroy"])->name('staff.destroy');

//Route::resource('/staff', StaffController::class );

