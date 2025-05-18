<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;

// ====================
// ROUTE UNTUK USER (FRONTEND)
// ====================

Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('products', [HomepageController::class, 'products'])->name('products');
Route::get('product/{slug}', [HomepageController::class, 'product'])->name('product');
Route::get('categories', [HomepageController::class, 'categories'])->name('categories.index');
Route::get('category/{slug}', [HomepageController::class, 'category'])->name('categories.show');
Route::get('cart', [HomepageController::class, 'cart'])->name('cart');
Route::get('checkout', [HomepageController::class, 'checkout'])->name('checkout');

Route::patch('/products/{id}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');


// ====================
// ROUTE DASHBOARD
// ====================

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Pindahkan route produk ke dalam prefix dashboard supaya nama route-nya jadi dashboard.products.*
Route::prefix('dashboard')->middleware(['auth'])->name('dashboard.')->group(function () {
    Route::resource('categories', ProductCategoryController::class);
    Route::resource('products', ProductController::class);
});

// Route produk di luar prefix dashboard tapi dengan middleware auth
Route::resource('products', ProductController::class)->middleware(['auth']);


// ====================
// ROUTE SETTINGS (LIVEWIRE VOLT)
// ====================

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';