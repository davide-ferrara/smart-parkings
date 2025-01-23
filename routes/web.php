<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\ParkingLotController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserCreditController;
use App\Http\Controllers\UserCarController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('home');
});

// Auth
Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/register', [RegistredUserController::class, 'create']);
Route::post('/register', [RegistredUserController::class, 'store']);

Route::get('/parking/{lot_number}', [ParkingController::class, 'show'])->name('parking.show')->middleware('auth');
Route::post('/parking', [ParkingController::class, 'store'])->name('parking.store')->middleware('auth');
Route::put('/parking/{lot_number}', [ParkingController::class, 'update'])->name('parking.update')->middleware('auth');

// Admin Panel
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'panelView'])->middleware('auth');

    // Parking admin side
    Route::get('/parking', [ParkingLotController::class, 'index'])->middleware('auth');

    Route::get('/parking/add', [ParkingLotController::class, 'addParkingView'])->middleware('auth');
    Route::post('/parking', [ParkingLotController::class, 'store'])->middleware('auth');

    Route::get('/parking/update/{lot_number}', [ParkingLotController::class, 'edit'])->middleware('auth');
    Route::put('/parking/{lot_number}', [ParkingLotController::class, 'update'])->middleware('auth');
    Route::delete('/parking/{lot_number}', [ParkingLotController::class, 'destroy'])->middleware('auth');

});

// Profile
Route::prefix('profile')->group(function () {
    Route::get('/{id}', [ProfileController::class, 'create'])->middleware('auth');
    Route::put('/{id}', [ProfileController::class, 'update'])->middleware('auth');

    // Credit
    Route::get('/credit/{id}', [UserCreditController::class, 'show'])->middleware('auth');
    Route::put('/credit/{id}', [UserCreditController::class, 'update'])->middleware('auth');

    // Cars
    Route::get('/cars/register', [UserCarController::class, 'showRegisterCarView'])->middleware('auth');
    Route::get('/cars/update/{id}', [UserCarController::class, 'showUpdateCarView'])->name('cars.update_view')->middleware('auth');

    Route::post('/cars', [UserCarController::class, 'store'])->name('cars.store')->middleware('auth');
    Route::get('/cars/{id}', [UserCarController::class, 'show'])->name('cars.show')->middleware('auth');
    Route::put('/cars/{id}', [UserCarController::class, 'update'])->name('cars.update')->middleware('auth');
    Route::delete('/cars/{id}', [UserCarController::class, 'destroy'])->name('cars.destroy')->middleware('auth');

    Route::get('/active-parking/{id}', [ProfileController::class, 'activeParkingView'])->name('profile.active_parking')->middleware('auth');

});

