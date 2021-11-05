<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeCharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('test', [IndexController::class, 'test']);

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('characters', CharacterController::class);
    Route::apiResource('locations', LocationController::class);
    Route::apiResource('episodes', EpisodeController::class);
    Route::apiResource('episodes.characters', EpisodeCharacterController::class)->only(['index', 'store', 'destroy']);
    Route::get('characters/{character}/episodes', [CharacterController::class, 'indexCharacterEpisodes']);

    Route::post('character/set-image', [CharacterController::class, 'setImage']);
    Route::delete('character/delete-image', [CharacterController::class, 'deleteImage']);
    Route::post('location/set-image', [LocationController::class, 'setImage']);
    Route::delete('location/delete-image', [LocationController::class, 'deleteImage']);
    Route::post('episode/set-image', [EpisodeController::class, 'setImage']);
    Route::delete('episode/delete-image', [EpisodeController::class, 'deleteImage']);

    Route::post('auth/login', [AuthController::class, 'login']);
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::get('cabinet/users/my', [AuthController::class, 'cabinet'])->middleware('auth:sanctum');
    Route::post('cabinet/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});
