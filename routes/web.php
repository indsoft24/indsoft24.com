<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// --- Main Public Routes ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact-lead-store', [ContactController::class, 'store'])->name('contact.store');
Route::post('/leads-store', [LeadController::class, 'store'])->name('leads.store');

Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');

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
Route::view('/contact-us', 'company.contact')->name('contact');
Route::view('/privacy-policy', 'company.privacy-policy')->name('privacy.policy');
Route::view('/terms-conditions', 'company.terms-and-conditions')->name('terms.conditions');
Route::view('/cookie-policy', 'company.cookie-policy')->name('cookie.policy');

// Career Pages
Route::get('/career', [CareerController::class, 'index'])->name('career.index');
Route::post('/career/apply', [CareerController::class, 'apply'])->name('career.apply');

// Service Pages
Route::view('/services', 'services.index')->name('services.index');
Route::view('/web-development', 'services.web-development')->name('services.web');
Route::view('/app-development', 'services.app-development')->name('services.app');
Route::view('/software-development', 'services.software-development')->name('services.software');
Route::view('/seo-services', 'services.seo-services')->name('services.seo');
Route::view('/digital-marketing', 'services.digital-marketing')->name('services.digital-marketing');
Route::view('/social-media-marketing', 'services.social-media-marketing')->name('services.social-media-marketing');

// E-commerce Page
Route::view('/e-commerce', 'e-commerce.index')->name('e-commerce');

// Tools routes are in routes/tools.php

// --- Sitemap Routes ---
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap-static.xml', [SitemapController::class, 'staticPages'])->name('sitemap.static');
Route::get('/sitemap-posts-{page}.xml', [SitemapController::class, 'posts'])->where('page', '[0-9]+')->name('sitemap.posts');
Route::get('/sitemap-categories.xml', [SitemapController::class, 'categories'])->name('sitemap.categories');
Route::get('/sitemap-tags.xml', [SitemapController::class, 'tags'])->name('sitemap.tags');
Route::get('/sitemap-projects.xml', [SitemapController::class, 'projects'])->name('sitemap.projects');
Route::get('/sitemap-pages-{page}.xml', [SitemapController::class, 'pages'])->where('page', '[0-9]+')->name('sitemap.pages');
Route::get('/sitemap-states.xml', [SitemapController::class, 'states'])->name('sitemap.states');
Route::get('/sitemap-cities-{page}.xml', [SitemapController::class, 'cities'])->where('page', '[0-9]+')->name('sitemap.cities');
Route::get('/sitemap-areas-{page}.xml', [SitemapController::class, 'areas'])->where('page', '[0-9]+')->name('sitemap.areas');

// CMS routes are in routes/cms.php

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

// Admin routes are in routes/admin.php
