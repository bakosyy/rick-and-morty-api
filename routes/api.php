<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeCharacterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('test', [IndexController::class, 'test']);

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('characters', CharacterController::class);
    Route::apiResource('images', ImageController::class)->only(['store', 'destroy']);
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
});
