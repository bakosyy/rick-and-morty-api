<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LocationController;

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
    Route::get('episodes/{episode}/characters', [EpisodeController::class, 'character']);
    Route::post('episodes/{characterId}/characters', [EpisodeController::class, 'storeCharacter']);
    Route::delete('episodes/{episode}/characters', [EpisodeController::class, 'deleteCharacter']);
});
