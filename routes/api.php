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
    Route::get('/{id}', [CabinController::class, 'show']);
    Route::put('/{id}', [CabinController::class, 'update']);
    Route::delete('/{id}', [CabinController::class, 'destroy']);
});

Route::prefix('cabin-levels')->group(function () {
    Route::get('/', [CabinLevelController::class, 'index']);
    Route::post('/', [CabinLevelController::class, 'store']);
    Route::get('/{id}', [CabinLevelController::class, 'show']);
    Route::put('/{id}', [CabinLevelController::class, 'update']);
    Route::delete('/{id}', [CabinLevelController::class, 'destroy']);
});

Route::prefix('cabin-services')->group(function () {
    Route::get('/', [CabinServiceController::class, 'index']);
    Route::post('/', [CabinServiceController::class, 'store']);
    Route::get('/{id}', [CabinServiceController::class, 'show']);
    Route::put('/{id}', [CabinServiceController::class, 'update']);
    Route::delete('/{id}', [CabinServiceController::class, 'destroy']);
});

Route::prefix('reservations')->group(function () {
    Route::get('/', [ReservationController::class, 'index']);
    Route::post('/', [ReservationController::class, 'store']);
    Route::get('/{id}', [ReservationController::class, 'show']);
    Route::put('/{id}', [ReservationController::class, 'update']);
    Route::delete('/{id}', [ReservationController::class, 'destroy']);
});

Route::prefix('services')->group(function () {
    Route::get('/', [ServiceController::class, 'index']);
    Route::post('/', [ServiceController::class, 'store']);
    Route::get('/{id}', [ServiceController::class, 'show']);
    Route::put('/{id}', [ServiceController::class, 'update']);
    Route::delete('/{id}', [ServiceController::class, 'destroy']);
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});
