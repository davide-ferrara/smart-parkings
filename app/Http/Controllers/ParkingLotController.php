<?php

namespace App\Http\Controllers;

use App\Models\ParkingLot;
use Illuminate\Database\QueryException;

class ParkingLotController extends Controller
{
    public function index()
    {
        $parkingLots = ParkingLot::all(); // Recupera tutti i parking lot

        return view('admin.parking_lots', compact('parkingLots')); // Restituisce la vista con i dati
    }

    public static function create()
    {
        return view('admin.add_parking_lot');
    }

    public static function store()
    {
        $validatedParkingLot = request()->validate([
            //'lat' => ['required', 'decimal: 2,15'],
            //'lng' => ['required', 'decimal: 2,15'],
            'lat' => ['required'],
            'lng' => ['required'],
            'lot_number' => 'nullable',
            'address' => 'nullable',
            'zone_id' => 'nullable',
        ]);

        try {
            ParkingLot::create($validatedParkingLot);

            return redirect('/admin/parking_lot')->with([
                'success' => 'Parking lot created!',
            ]);
        } catch (QueryException $e) {
            dd($e);
        }
    }
}
