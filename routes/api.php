<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabinController;
use App\Http\Controllers\CabinLevelController;
use App\Http\Controllers\CabinServiceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;

Route::prefix('cabins')->group(function () {
    Route::get('/', [CabinController::class, 'index']);
    Route::post('/', [CabinController::class, 'store']);
    Route::get('/{cabin}', [CabinController::class, 'show']);
    Route::put('/{cabin}', [CabinController::class, 'update']);
    Route::delete('/{cabin}', [CabinController::class, 'destroy']);
});

Route::prefix('cabin-levels')->group(function () {
    Route::get('/', [CabinLevelController::class, 'index']);
    Route::get('/or', [CabinLevelController::class, 'index2']);
    Route::post('/', [CabinLevelController::class, 'store']);
    Route::get('/{cabinLevel}', [CabinLevelController::class, 'show']);
    Route::put('/{cabinLevel}', [CabinLevelController::class, 'update']);
    Route::delete('/{cabinLevel}', [CabinLevelController::class, 'destroy']);
});

Route::prefix('cabin-services')->group(function () {
    Route::get('/', [CabinServiceController::class, 'index']);
    Route::post('/', [CabinServiceController::class, 'store']);
    Route::get('/{cabin-service}', [CabinServiceController::class, 'show']);
    Route::put('/{cabin-service}', [CabinServiceController::class, 'update']);
    Route::delete('/{cabin-service}', [CabinServiceController::class, 'destroy']);
});

Route::prefix('reservations')->group(function () {
    Route::get('/', [ReservationController::class, 'index']);
    Route::post('/', [ReservationController::class, 'store']);
    Route::get('/{reservation}', [ReservationController::class, 'show']);
    Route::put('/{reservation}', [ReservationController::class, 'update']);
    Route::delete('/{reservation}', [ReservationController::class, 'destroy']);
});

Route::prefix('services')->group(function () {
    Route::get('/', [ServiceController::class, 'index']);
    Route::post('/', [ServiceController::class, 'store']);
    Route::get('/{service}', [ServiceController::class, 'show']);
    Route::put('/{service}', [ServiceController::class, 'update']);
    Route::delete('/{service}', [ServiceController::class, 'destroy']);
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
});
