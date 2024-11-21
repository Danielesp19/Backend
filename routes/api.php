<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabinController;
use App\Http\Controllers\CabinLevelController;
use App\Http\Controllers\CabinServiceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;

// Rutas públicas
Route::prefix('cabins')->group(function () {
    // Listar cabañas disponibles (todos)
    Route::get('/', [CabinController::class, 'index']); 
    
    // Filtrar cabañas por nivel, nombre, o aforo (por defecto aforo ascendente)
    Route::get('/filter', [CabinController::class, 'filter']); 
    
    // Incluir cabañas con ciertos servicios
    Route::get('/filter-by-services', [CabinController::class, 'filterByServices']); 
    
    // Reservar cabaña (todos)
    Route::post('/reservations', [ReservationController::class, 'store']); 
});

// Rutas de autenticación
Route::post('/v1/login', [App\Http\Controllers\api\v1\AuthController::class, 'login'])->name('api.login');

// Rutas protegidas por autenticación (requieren token)
Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('/v1/logout', [App\Http\Controllers\api\v1\AuthController::class, 'logout'])->name('api.logout');
        // Gestión de cabañas (administradores)
        Route::prefix('cabins')->group(function () {
            Route::post('/', [CabinController::class, 'store']);  // Crear cabaña
            Route::put('/{cabin}', [CabinController::class, 'update']); // Actualizar cabaña
            Route::delete('/{cabin}', [CabinController::class, 'destroy']); // Eliminar cabaña
            Route::get('/reserved', [CabinController::class, 'reserved']); // Listar cabañas reservadas
        });

        // Gestión de niveles de cabañas (administradores)
        Route::prefix('cabin-levels')->group(function () {
            Route::post('/', [CabinLevelController::class, 'store']); // Crear nivel de cabaña
            Route::put('/{cabinLevel}', [CabinLevelController::class, 'update']); // Actualizar nivel de cabaña
            Route::delete('/{cabinLevel}', [CabinLevelController::class, 'destroy']); // Eliminar nivel de cabaña
        });

        // Gestión de servicios (administradores)
        Route::prefix('services')->group(function () {
            Route::post('/', [ServiceController::class, 'store']);  // Crear servicio
            Route::put('/{service}', [ServiceController::class, 'update']); // Actualizar servicio
            Route::delete('/{service}', [ServiceController::class, 'destroy']); // Eliminar servicio
        });

        // Gestión de servicios en cabañas (administradores)
        Route::prefix('cabin-services')->group(function () {
            Route::post('/', [CabinServiceController::class, 'store']);  // Asignar servicio a cabaña
            Route::put('/{cabinService}', [CabinServiceController::class, 'update']); // Actualizar servicio en cabaña
            Route::delete('/{cabinService}', [CabinServiceController::class, 'destroy']); // Eliminar servicio en cabaña
        });

        // Liberar cabaña (administradores)
        Route::put('/reservations/{reservation}/release', [ReservationController::class, 'release']); // Liberar cabaña
    });

    // Gestión de usuarios (administradores)
    Route::middleware(['user_type:admin'])->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index']);  // Listar usuarios
            Route::get('/{user}', [UserController::class, 'show']); // Ver usuario
            Route::put('/{user}', [UserController::class, 'update']); // Actualizar usuario
            Route::delete('/{user}', [UserController::class, 'destroy']); // Eliminar usuario
        });
});

// Rutas públicas para crear usuarios (sin token)
Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store']); // Crear usuario (no requiere token)
});