<?php

namespace App\Http\Controllers;

use App\Models\ParkingLot;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ParkingLotController extends Controller
{
    public function index() {
        $parkingLots = ParkingLot::all(); // Recupera tutti i parking lot
        return view('admin.parking_lots', compact('parkingLots')); // Restituisce la vista con i dati
    }
    static public function create() {
        return view('admin.add_parking_lot');
    }
    static public function store () {
        $validatedParkingLot = request()->validate([
            //'lat' => ['required', 'decimal: 2,15'],
            //'lng' => ['required', 'decimal: 2,15'],
            'lat' => ['required'],
            'lng' => ['required'],
            'lot_number' => ['required'],
            'address' => 'nullable',
            'zone' => 'nullable',
        ]);
        
        try {
            ParkingLot::create($validatedParkingLot);
            return redirect('/admin/parking_lot')->with(['success' => 'Parking Lot created!']);
        } catch (QueryException $e) {
            return redirect('/admin/parking_lot')->withErrors(['lot_number' => 'Il numero del parcheggio deve essere unico.']);
        }

    }

}
