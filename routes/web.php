<?php
// Qui specifichiamo API che ritornano view, in API.php invece oggetti (JSON)

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
create, store, edit, update e destroy è comune in Laravel per gestire le operazioni CRUD
*/

Route::get('/', function () {
    return view('home', ['name' => 'dave']);
});

Route::get('/admin', function () {
    return view('admin.panel');
});

Route::get('/admin/add_parking', function () {
    return view('admin.add_parking');
});

Route::get('/profile/{id}', function ($id) {
    return ProfileController::create($id);
});

// Auth
Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('/register', [RegistredUserController::class, 'create']);
Route::post('/register', [RegistredUserController::class, 'store']);


