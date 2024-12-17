<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\ParkingLotController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserCreditController;
use Illuminate\Support\Facades\Route;

// Qui specifichiamo API che ritornano view, in API.php invece oggetti (JSON)
// create, store, edit, update e destroy è comune in Laravel per gestire le operazioni CRUD

// Home
Route::get('/', function () {
    return view('home', ['name' => 'dave']);
});

// Auth
Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('/register', [RegistredUserController::class, 'create']);
Route::post('/register', [RegistredUserController::class, 'store']);

// Admin Panel
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'panelView']);

    Route::get('/parking_lot', [ParkingLotController::class, 'create']);
    Route::post('/parking_lot', [ParkingLotController::class, 'store']);

    Route::get('/parking_lots', [ParkingLotController::class, 'index']);
});

// Profile
Route::prefix('profile')->group(function () {
    Route::get('/{id}', [ProfileController::class, 'create']);
    Route::put('/{id}', [ProfileController::class, 'update']);

    // Credit
    Route::get('/credit/{id}', [UserCreditController::class, 'show']);
    Route::put('/credit/{id}', [UserCreditController::class, 'update']);

});
