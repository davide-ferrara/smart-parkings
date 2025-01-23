<?php

namespace App\Http\Controllers;

use App\Models\ParkingLot;
use App\Models\ParkingLotZone;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParkingLotController extends Controller
{
    public function index()
    {
        $parkingLots = ParkingLot::all(); // Recupera tutti i parking lot

        return view('admin.parking_lots', compact('parkingLots')); // Restituisce la vista con i dati
    }

    public static function addParkingView()
    {
        $parkingLotZones = ParkingLotZone::all();

        return view('admin.add_parking_lot', compact('parkingLotZones'));
    }

    public static function store()
    {
        $validatedParkingLot = request()->validate([
            'lat' => ['required', 'decimal: 2,15'],
            'lng' => ['required', 'decimal: 2,15'],
            //'lat' => ['required'],
            //'lng' => ['required'],
            'lot_number' => ['nullable', 'integer'],
            'address' =>  ['required'],
            'zone_id' => ['required', 'integer'],
            'occupied_by' => ['nullable'],
            'license_plate' => ['nullable', 'max:7'],
        ]);

        try {
            ParkingLot::create($validatedParkingLot);

            return back()->with([
                'success' => 'Parking lot created!',
            ]);
        } catch (QueryException $e) {
            // Non dimenticare di eseguire 'php artisan db:seed'
            Log::error($e->getMessage());
            return back()->withErrors([
                'error' => 'Parking could not be created!',
            ]);
        }
    }

    public function edit($lot_number) {
        $parkingLot = DB::table("parking_lots")->where('lot_number', $lot_number)->first();
        return view('admin.parking_lots_update', compact('parkingLot'));
    }

    public function update($lot_number) {
        $validatedParkingLot = request()->validate([
            'lat' => ['required', 'decimal: 2,15'],
            'lng' => ['required', 'decimal: 2,15'],
            'lot_number' => ['required', 'integer'],
            'address' =>  ['required'],
            'zone_id' => ['required', 'integer'],
            'occupied_by' => ['nullable'],
            'license_plate' => ['nullable', 'max:7'],
        ]);

        try {
            DB::table("parking_lots")->where('lot_number', $lot_number)->update($validatedParkingLot);

            return back()->with('success', 'Parking lot successfully updated!');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return back()->withErrors(['error' => 'Parking could not be updated!']);
        }
    }

    public function destroy($lot_number) {
        try {
            DB::table("parking_lots")->where('lot_number', $lot_number)->delete();

            return back()->with('success', 'Parking lot successfully deleted!');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return back()->withErrors(['error' => 'Parking could not be deleted!']);
        }
    }

}
