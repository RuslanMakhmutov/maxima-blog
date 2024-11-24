<?php

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::get('/', HomeController::class)->name('home');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [AdminPostController::class, 'index'])->name('index');
        // Route::post('store', [AdminPostController::class, 'store'])->name('store');
        // Route::get('{post}/show', [AdminPostController::class, 'show'])->name('show');
        // Route::put('{post}/update', [AdminPostController::class, 'update'])->name('update');
        // Route::delete('{post}/delete', [AdminPostController::class, 'delete'])->name('delete');
        // Route::delete('{post}/destroy', [AdminPostController::class, 'destroy'])->name('destroy')->withTrashed();
    });
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
