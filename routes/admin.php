<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadController as AdminLeadController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SitemapController as AdminSitemapController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

// --- Admin Routes ---
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes for login/register
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
    });

    // Auth routes for admin panel
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // --- Blog Management ---
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::resource('posts', PostController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('tags', TagController::class);
            Route::resource('comments', AdminCommentController::class)->only(['index', 'edit', 'update', 'destroy']);
            Route::post('posts/upload-image', [PostController::class, 'uploadImage'])->name('posts.uploadImage');
        });

        // --- CMS Pages Management ---
        Route::prefix('cms')->name('cms.')->group(function () {
            // Location Management
            Route::resource('states', StateController::class);
            Route::resource('cities', CityController::class);
            Route::resource('areas', AreaController::class);

            // AJAX routes for location dependencies
            Route::get('cities/by-state', [CityController::class, 'getByState'])->name('cities.byState');
            Route::get('areas/by-city', [AreaController::class, 'getByCity'])->name('areas.byCity');

            // Pages Management
            Route::resource('pages', PageController::class);
            Route::post('pages/bulk-action', [PageController::class, 'bulkAction'])->name('pages.bulkAction');
            Route::get('pages/export', [PageController::class, 'export'])->name('pages.export');
            Route::post('pages/{page}/duplicate', [PageController::class, 'duplicate'])->name('pages.duplicate');
            Route::post('pages/{page}/quick-status', [PageController::class, 'quickUpdateStatus'])->name('pages.quickStatus');
            Route::post('pages/{page}/toggle-featured', [PageController::class, 'quickToggleFeatured'])->name('pages.toggleFeatured');
            Route::post('pages/upload-image', [PageController::class, 'uploadImage'])->name('pages.uploadImage');
        });

        // --- Projects Management ---
        Route::resource('projects', AdminProjectController::class);

        // --- Subscriber Management ---
        Route::prefix('subscribers')->name('subscribers.')->group(function () {
            Route::get('/', [SubscriberController::class, 'index'])->name('index');
            Route::delete('/{subscriber}', [SubscriberController::class, 'destroy'])->name('destroy');
            Route::get('/export', [SubscriberController::class, 'export'])->name('export');
        });

        // --- Lead Management ---
        Route::prefix('leads')->name('leads.')->group(function () {
            Route::get('/', [AdminLeadController::class, 'index'])->name('index');
            Route::get('/{lead}', [AdminLeadController::class, 'show'])->name('show');
            Route::put('/{lead}/status', [AdminLeadController::class, 'updateStatus'])->name('updateStatus');
            Route::put('/{lead}/notes', [AdminLeadController::class, 'updateNotes'])->name('updateNotes');
            Route::post('/{lead}/toggle-read', [AdminLeadController::class, 'toggleRead'])->name('toggleRead');
            Route::delete('/{lead}', [AdminLeadController::class, 'destroy'])->name('destroy');
        });

        // --- Sitemap Management ---
        Route::prefix('sitemap')->name('sitemap.')->group(function () {
            Route::get('/', [AdminSitemapController::class, 'index'])->name('index');
            Route::post('/clear-cache', [AdminSitemapController::class, 'clearCache'])->name('clearCache');
            Route::get('/preview', [AdminSitemapController::class, 'preview'])->name('preview');
        });
    });
});
