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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\TrackingController;

// Removed default welcome route, as dynamic pages will handle /
Route::get('/', [HomeController::class, 'index'])->name('home');

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

    // Homepage Settings Routes
    Route::get('settings/home', [SettingController::class, 'home'])->name('settings.home');
    Route::post('settings/home', [SettingController::class, 'updateHome'])->name('settings.home.update');

    // SEO Settings Routes
    Route::get('settings/seo', [SettingController::class, 'seo'])->name('settings.seo');
    Route::post('settings/seo', [SettingController::class, 'updateSeo'])->name('settings.seo.update');

    // General Settings Routes
    Route::get('settings/general', [SettingController::class, 'general'])->name('settings.general');
    Route::post('settings/general', [SettingController::class, 'updateGeneral'])->name('settings.general.update');

    // Catalog Management
    Route::resource('brands', BrandController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('colors', ColorController::class);

    // Media Library
    Route::get('media', [MediaController::class, 'index'])->name('media.index');
    Route::post('media', [MediaController::class, 'store'])->name('media.store');
    Route::patch('media/{medium}', [MediaController::class, 'update'])->name('media.update');
    Route::delete('media/{medium}', [MediaController::class, 'destroy'])->name('media.destroy');

    // Users Management
    Route::resource('users', UserController::class);

    // Lead Management
    Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
    Route::patch('leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('leads.status');
    Route::patch('leads/{lead}/notes', [LeadController::class, 'updateNotes'])->name('leads.notes');
    Route::delete('leads/{lead}', [LeadController::class, 'destroy'])->name('leads.destroy');
});

// Frontend Tracking (public, no auth)
Route::post('/track/pageview', [TrackingController::class, 'trackPageView'])->name('track.pageview');
Route::post('/track/product', [TrackingController::class, 'trackProductView'])->name('track.product');
Route::post('/track/whatsapp', [TrackingController::class, 'trackWhatsappClick'])->name('track.whatsapp');
Route::post('/lead', [TrackingController::class, 'submitLead'])->name('lead.submit');

// Dynamic Frontend Pages
Route::get('/{slug?}', [PageController::class, 'show'])->name('page.show');
