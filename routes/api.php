<?php

use App\Models\ParkingLot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::get('/parking-lots', function () {
    Log::info("[api.php] Sending parking lots json");
    return ParkingLot::all();
});
