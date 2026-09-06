<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/conversations', [ConversationController::class, 'index']);
    Route::post('/conversations', [ConversationController::class, 'store']);
    Route::get('/conversations/{conversation}', [ConversationController::class, 'show']);

    Route::get(
        '/conversations/{conversation}/messages',
        [MessageController::class, 'index']
    );

    Route::post(
        '/conversations/{conversation}/messages',
        [MessageController::class, 'store']
    );

    Route::patch('/messages/{message}', [MessageController::class, 'update']);
});