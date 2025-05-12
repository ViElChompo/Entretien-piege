<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\StoryController;
use App\Http\Controllers\Api\V1\ChapterController;
use App\Http\Controllers\Api\V1\ProgressController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\AdminController;
use App\Http\Middleware\AdminMiddleware;



// Test route – does this show up?
Route::get('ping', function () {
    return response()->json(['pong']);
});

Route::prefix('v1')->group(function () {
    // Authentication
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // Public endpoints
    Route::get('stories', [StoryController::class, 'index']);
    Route::get('stories/{story}', [StoryController::class, 'show']);
    Route::get('chapters/{chapter}', [ChapterController::class, 'show']);

    // Protected endpoints (requires sanctum token)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('progress/save', [ProgressController::class, 'store']);
        Route::get('progress/{story}', [ProgressController::class, 'show']);
    });


    Route::middleware(['auth:sanctum', AdminMiddleware::class])->group(function () {
        Route::get('/admin/only', [AdminController::class, 'adminOnly'])->name('admin.only');
    });


});
