<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\StoryController;
use App\Http\Controllers\Api\V1\ChapterController;
use App\Http\Controllers\Api\V1\ProgressController;
use App\Http\Controllers\Api\V1\AuthController;

// Routes d'authentification
Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    
    // Routes publiques
    Route::get('/stories', [StoryController::class, 'index']);
    Route::get('/stories/{story}', [StoryController::class, 'show']);
    Route::get('/chapters/{chapter}', [ChapterController::class, 'show']);
    
    // Routes protégées
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/progress/save', [ProgressController::class, 'store']);
        Route::get('/progress/{story}', [ProgressController::class, 'show']);
    });
});