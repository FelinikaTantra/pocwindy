<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PageBuilderController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CatalogPdfController;

// Removed default welcome route, as dynamic pages will handle /

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::delete('products/images/{id}', [ProductController::class, 'destroyImage'])->name('products.images.destroy');
    
    // PDF Generation
    Route::get('catalog/pdf', [CatalogPdfController::class, 'download'])->name('catalog.pdf');

    // Page Builder Routes
    Route::resource('pages', PageBuilderController::class);
    Route::get('pages/{page}/builder', [PageBuilderController::class, 'builder'])->name('pages.builder');
    Route::post('pages/{page}/blocks', [PageBuilderController::class, 'saveBlocks'])->name('pages.blocks.save');

    // Theme Customizer Routes
    Route::get('theme', [ThemeController::class, 'index'])->name('theme.index');
    Route::post('theme', [ThemeController::class, 'save'])->name('theme.save');
});

// Dynamic Frontend Pages
Route::get('/{slug?}', [PageController::class, 'show'])->name('page.show');
