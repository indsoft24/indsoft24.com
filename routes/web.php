<?php
use App\Http\Controllers\Admin\CommentController as AdminCommentController;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\CareerController;

// Main website routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/verify', [NewsletterController::class, 'showVerificationForm'])->name('newsletter.verify.form');
Route::post('/newsletter/verify', [NewsletterController::class, 'verifyOtp'])->name('newsletter.verify.otp');

// Google OAuth routes
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home')->with('success', 'Successfully logged out!');
})->name('logout');

// User Blog Management Routes (using existing admin system)
Route::prefix('my-blog')->name('user.blog.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('store');
    Route::get('/{post}', [App\Http\Controllers\Admin\PostController::class, 'show'])->name('show');
    Route::get('/{post}/edit', [App\Http\Controllers\Admin\PostController::class, 'edit'])->name('edit');
    Route::put('/{post}', [App\Http\Controllers\Admin\PostController::class, 'update'])->name('update');
    Route::delete('/{post}', [App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('destroy');
});


// Blog routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{post:slug}', [BlogController::class, 'show'])->name('show');
    Route::get('/category/{category:slug}', [BlogController::class, 'category'])->name('category');
    Route::get('/tag/{tag:slug}', [BlogController::class, 'tag'])->name('tag');
    Route::post('/{post:id}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
    Route::post('/{post:id}/like', [LikeController::class, 'toggle'])->name('posts.like')->middleware('auth');
});

//company routes
Route::get('/about-us', function () {
    return view('company.about');
})->name('about');
Route::get('/our-team', function () {
    return view('company.team');
})->name('team');
Route::get('/privacy-policy', function () {
    return view('company.privacy-policy');
})->name('privacy.policy');
Route::get('/terms-conditions', function () {
    return view('company.terms-and-conditions');
})->name('terms.conditions');
Route::get('/cookie-policy', function () {
    return view('company.cookie-policy');
})->name('cookie.policy');
Route::get('/career', [CareerController::class, 'index'])->name('career.index');
Route::post('/career/apply', [CareerController::class, 'apply'])->name('career.apply');

// service section
Route::get('/web-development', function () {
    return view('services.web-development');
})->name('services.web');

// e-commerce section
Route::get('/e-commerce', function () {
    $launchDate = config('app.launch_date') ?? env('LAUNCH_DATE');
        $siteName = config('app.name') ?? env('SITE_NAME', 'IndSoft24');
        $discount = env('LAUNCH_SIGNUP_DISCOUNT', null);
    return view('e-commerce.index', compact('launchDate', 'siteName', 'discount'));
})->name('e-commerce');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    

    // Protected admin routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
        Route::delete('subscribers/{subscriber}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');
        Route::get('subscribers/export', [SubscriberController::class, 'export'])->name('subscribers.export');
        // Posts management
        Route::resource('posts', PostController::class);

        // Categories management
        Route::resource('categories', CategoryController::class);

        // Tags management
        Route::resource('tags', TagController::class);
        
        //Comment Management
        Route::resource('comments', AdminCommentController::class)->only([
            'index', 'edit', 'update', 'destroy'
        ]);
        
        Route::post('posts/upload-image', [PostController::class, 'uploadImage'])->name('posts.uploadImage');
    });
});

