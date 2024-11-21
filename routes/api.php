<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabinController;
use App\Http\Controllers\CabinLevelController;
use App\Http\Controllers\CabinServiceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Models\Reservation;

// Rutas públicas
Route::prefix('cabins')->group(function () {
    // Listar cabañas disponibles
    Route::get('/avalible', [CabinController::class, 'avalible']);
    // Filtrar cabañas por nivel, nombre, o aforo
    Route::get('/filter', [CabinController::class, 'index']);
    // Incluir cabañas con ciertos servicios
    Route::get('/filter-by-services', [CabinController::class, 'filterByServices']);
    // Reservar cabaña (todos los usuarios)
    Route::post('/reservations', [ReservationController::class, 'store']);
});


Route::post('/v1/login', [App\Http\Controllers\Api\V1\AuthController::class, 'login'])->name('api.login');
Route::middleware(['auth:sanctum'])->post('/v1/logout', [App\Http\Controllers\Api\V1\AuthController::class, 'logout'])->name('api.logout');


Route::middleware(['auth:sanctum', EnsureUserIsAdmin::class])->group(function () {
    // cabañas
    Route::prefix('cabins')->group(function () {
        Route::post('/', [CabinController::class, 'store']); // Crear cabaña
        Route::put('/{cabin}', [CabinController::class, 'update']); // Actualizar cabaña
        Route::delete('/{cabin}', [CabinController::class, 'destroy']); // Eliminar cabaña
        Route::get('/reserved', [CabinController::class, 'reserved']); // Listar cabañas reservadas -----
        Route::patch('/release/{cabin}', [CabinController::class, 'release']); // Liberar cabaña  -----
    });

    //  niveles de cabañas
    Route::prefix('cabin-levels')->group(function () {
        Route::post('/', [CabinLevelController::class, 'store']); // Crear nivel
        Route::get('/', [CabinLevelController::class, 'index']); // Crear nivel
        Route::get('/{cabinLevel}', [CabinLevelController::class, 'show']); // Crear nivel
        Route::put('/{cabinLevel}', [CabinLevelController::class, 'update']); // Actualizar nivel
        Route::delete('/{cabinLevel}', [CabinLevelController::class, 'destroy']); // Eliminar nivel
    });

    //  servicios
    Route::prefix('services')->group(function () {
        Route::post('/', [ServiceController::class, 'store']); // Crear servicio
        Route::get('/', [ServiceController::class, 'index']); // Crear servicio
        Route::put('/{service}', [ServiceController::class, 'update']); // Actualizar servicio
        Route::delete('/{service}', [ServiceController::class, 'destroy']); // Eliminar servicio
    });

    //  usuarios
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']); // Listar usuarios
        Route::get('/{user}', [UserController::class, 'show']); // Ver detalle de usuario
        Route::put('/{user}', [UserController::class, 'update']); // Actualizar usuario
        Route::delete('/{user}', [UserController::class, 'destroy']); // Eliminar usuario
    });

    //  servicios en cabañas
    Route::prefix('cabin-services')->group(function () {
        Route::post('/', [CabinServiceController::class, 'store']); // Asignar servicio a cabaña
        Route::get('/', [CabinServiceController::class, 'index']); // Asignar servicio a cabaña
        Route::put('/{cabinService}', [CabinServiceController::class, 'update']); // Actualizar servicio en cabaña
        Route::delete('/{cabinService}', [CabinServiceController::class, 'destroy']); // Eliminar servicio en cabaña
    });

    //  usuarios
    Route::prefix('reservations')->group(function () {
        Route::get('/', [ReservationController::class, 'index']); // Listar usuarios
        Route::put('/{user}', [UserController::class, 'update']); // Actualizar usuario
        Route::delete('/{user}', [UserController::class, 'destroy']); // Eliminar usuario
    });
});

// Rutas públicas para creación de usuarios
Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store']); // Crear usuario
});
