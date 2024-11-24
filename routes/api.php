<?php

use App\Http\Controllers\API\Admin\AdminPostController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::controller(AuthController::class)->name('auth.')->group(function () {
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
    });

    Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::prefix('posts')->name('posts.')->group(function () {
            Route::get('index', [AdminPostController::class, 'index'])->name('index');
            Route::post('store', [AdminPostController::class, 'store'])->name('store');
            Route::get('{post}/show', [AdminPostController::class, 'show'])->name('show');
            Route::put('{post}/update', [AdminPostController::class, 'update'])->name('update');
            Route::delete('{post}/delete', [AdminPostController::class, 'delete'])->name('delete');
            Route::delete('{post}/destroy', [AdminPostController::class, 'destroy'])->name('destroy')->withTrashed();
        });
    });
});
