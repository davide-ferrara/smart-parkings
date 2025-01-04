<?php

namespace App\Http\Controllers;

use App\Models\ParkingLot;
use App\Models\ParkingLotZone;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ParkingLotController extends Controller
{
    public function index()
    {
        $parkingLots = ParkingLot::all(); // Recupera tutti i parking lot

        return view('admin.parking_lots', compact('parkingLots')); // Restituisce la vista con i dati
    }

    public static function create()
    {
        $parkingLotZones = ParkingLotZone::all();

        return view('admin.add_parking_lot', compact('parkingLotZones'));
    }

    public static function store()
    {
        $validatedParkingLot = request()->validate([
            //'lat' => ['required', 'decimal: 2,15'],
            //'lng' => ['required', 'decimal: 2,15'],
            'lat' => ['required'],
            'lng' => ['required'],
            'lot_number' => 'nullable',
            'address' =>  ['required'],
            'zone_id' => ['required'],
            'occupied_by' => ['nullable'],
            'license_plate' => ['nullable', 'max:7'],
        ]);

        try {
            ParkingLot::create($validatedParkingLot);

            return redirect('/admin/parking_lot')->with([
                'success' => 'Parking lot created!',
            ]);
        } catch (QueryException $e) {
            // Non dimenticare di eseguire 'php artisan db:seed'
            Log::error($e->getMessage());
            return redirect('/admin/parking_lot')->withErrors([
                'error' => 'Parking could not be created!',
            ]);
        }
    }
}
