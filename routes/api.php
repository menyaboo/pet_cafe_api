<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// auth
Route::controller(AuthController::class)
    ->prefix('auth')
    ->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
    }
);

// role, user is admin
Route::controller(RoleController::class)
    ->prefix('roles')
    ->middleware(['auth:sanctum', 'role:admin'])
    ->group(function () {
        Route::get('/','index');
        Route::post('/', 'store');
        Route::get('/{role}', 'show');
        Route::put('/{role}', 'update');
        Route::delete('/{role}', 'destroy');
    }
);

//user
Route::controller(UserController::class)
    ->prefix('users')
    ->group(function () {
        // auth user routes
        Route::middleware('auth:sanctum')
            ->prefix('auth')
            ->group(function () {
                Route::get('/','getAuthenticatedUser');
                Route::put('/','updateSelf');
            }
        );

        // auth admin routes
        Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
            Route::get('/','index');
            Route::get('/{user}', 'show');
            Route::put('/{user}', 'update');
            Route::delete('/{user}', 'destroy');
        });
    }
);


