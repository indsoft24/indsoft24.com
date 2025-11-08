<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// --- Controllers ---
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\LeadController;

// --- Admin Controllers ---
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\LeadController as AdminLeadController;


// --- Main Public Routes ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home')->with('success', 'Successfully logged out!');
})->name('logout');


// --- Newsletter Routes ---
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/verify', [NewsletterController::class, 'showVerificationForm'])->name('newsletter.verify.form');
Route::post('/newsletter/verify', [NewsletterController::class, 'verifyOtp'])->name('newsletter.verify.otp');


// --- Google OAuth Routes ---
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');


// --- Public Blog Routes ---
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{post:slug}', [BlogController::class, 'show'])->name('show');
    Route::get('/category/{category:slug}', [BlogController::class, 'category'])->name('category');
    Route::get('/tag/{tag:slug}', [BlogController::class, 'tag'])->name('tag');
    Route::post('/{post:id}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
    Route::post('/{post:id}/like', [LikeController::class, 'toggle'])->name('posts.like')->middleware('auth');
});

// --- Public Project Routes ---
Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/{project:slug}', [ProjectController::class, 'show'])->name('show');
});


// --- Static Page Routes ---
// Company Pages
Route::view('/about-us', 'company.about')->name('about');
Route::view('/our-team', 'company.team')->name('team');
Route::view('/privacy-policy', 'company.privacy-policy')->name('privacy.policy');
Route::view('/terms-conditions', 'company.terms-and-conditions')->name('terms.conditions');
Route::view('/cookie-policy', 'company.cookie-policy')->name('cookie.policy');

// Career Pages
Route::get('/career', [CareerController::class, 'index'])->name('career.index');
Route::post('/career/apply', [CareerController::class, 'apply'])->name('career.apply');

// Service Pages
Route::view('/web-development', 'services.web-development')->name('services.web');
Route::view('/app-development', 'services.app-development')->name('services.app');
Route::view('/software-development', 'services.software-development')->name('services.software');
Route::view('/seo-services', 'services.seo-services')->name('services.seo');

// E-commerce Page
Route::view('/e-commerce', 'e-commerce.index')->name('e-commerce');


// --- User-Specific Routes ---
Route::middleware('auth')->prefix('my-blog')->name('user.blog.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::get('/{post}', [PostController::class, 'show'])->name('show');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
    Route::put('/{post}', [PostController::class, 'update'])->name('update');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
});


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

        // Management Sections
        Route::resource('posts', PostController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('tags', TagController::class);
        Route::resource('comments', AdminCommentController::class)->only(['index', 'edit', 'update', 'destroy']);
        Route::resource('projects', AdminProjectController::class);
        
        // Subscriber Management
        Route::get('subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
        Route::delete('subscribers/{subscriber}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');
        Route::get('subscribers/export', [SubscriberController::class, 'export'])->name('subscribers.export');
        
        // Lead Management
        Route::get('leads', [AdminLeadController::class, 'index'])->name('leads.index');
        Route::get('leads/{lead}', [AdminLeadController::class, 'show'])->name('leads.show');
        Route::put('leads/{lead}/status', [AdminLeadController::class, 'updateStatus'])->name('leads.updateStatus');
        Route::put('leads/{lead}/notes', [AdminLeadController::class, 'updateNotes'])->name('leads.updateNotes');
        Route::post('leads/{lead}/toggle-read', [AdminLeadController::class, 'toggleRead'])->name('leads.toggleRead');
        Route::delete('leads/{lead}', [AdminLeadController::class, 'destroy'])->name('leads.destroy');
        
        // Utilities
        Route::post('posts/upload-image', [PostController::class, 'uploadImage'])->name('posts.uploadImage');
    });
});