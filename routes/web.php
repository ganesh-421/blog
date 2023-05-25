<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\VerificationController;

Route::middleware('auth')->group(function() {
    Route::get('/', [PostController::class, 'index'])->name('home');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('show');
    Route::post('/newsletter', [NewsletterController::class, '__invoke']);
    Route::post('/posts/{post}/comments', [PostCommentsController::class, 'store']);
    Route::post('/logout', [SessionsController::class, 'destroy']);
});


Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');
Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('/sessions', [SessionsController::class, 'store'])->middleware('guest');
// gate can be accessed as middleware too... we can eliminate our own middleware..
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::resource('admin/posts', AdminPostController::class)->except('show');

    // all these routes are handled automatically

    // Route::get('/admin/posts/create', [AdminPostController::class, 'create']);//->middleware('can:admin'); //to pass parameters.. middleware('can:admin, parameters')
    // Route::post('/admin/posts', [AdminPostController::class, 'store']);
    // Route::get('/admin/posts', [AdminPostController::class, 'index']);
    // Route::get('/admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    // Route::patch('/admin/posts/{post}', [AdminPostController::class, 'update']);
    // Route::delete('/admin/posts/{post}', [AdminPostController::class, 'destroy']);
});

Route::get('/email/verify', [VerificationController::class, 'show'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('verification.resend');