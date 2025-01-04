<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\ParkingLot;
use App\Models\ParkingLotHistory;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
class ParkingController extends Controller
{
    public function show($lot_number): View
    {
        if(self::parkingIsOccuped($lot_number)) {
            return view('errors.not_allowed');
        }
        return view('profile.buy_parking_lot', ['lot_number' => $lot_number]);
    }

    public function store()
    {
        // Validazione dei dati
        $validatedData = request()->validate([
            'user_id' => 'required|exists:users,id',
            'lot_number' => 'required|string|max:255',
            'start_parking' => 'required|date',
            'end_parking' => 'required|date|after:start_parking',
            'car_id' => 'required',
        ]);

        $start_parking = Carbon::parse($validatedData['start_parking']);
        $end_parking = Carbon::parse($validatedData['end_parking']);
        $user_id = $validatedData['user_id'];
        $lot_number= $validatedData['lot_number'];

        if (self::userIsAlreadyParked($user_id, $start_parking, $end_parking)) {
            Log::warning('[ParkingController] User ' . $user_id . " is already parked");
            return redirect()->route('profile.active_parking', $user_id)->withErrors(['error' => 'You are already parked!']);
        }

        // Calcolo prezzo in base alla zona
        $zone_id = DB::table('parking_lots')->where('lot_number', $lot_number)->value('zone_id');
        $price_per_hours = DB::table('parking_lot_zones')->where('id', $zone_id)->value('price_per_hours');

        $total_price = ($start_parking->diffInMinutes($end_parking) / 60) * $price_per_hours;
        $user_credit = DB::table('user_credits')->where('user_id', $user_id)->value('total');
        $new_credit = $user_credit - $total_price;

        if($new_credit < 0) {
            Log::warning('[ParkingController] User ' . $user_id . " not enough credit to buy parking");
            return back()->withErrors(['error' => 'Insufficient funds.']);
        }
        $car = Car::findOrFail($validatedData['car_id']);

        DB::beginTransaction();
        try {
            DB::table('user_credits')->where('user_id', $user_id)->decrement('total', $total_price);
            ParkingLotHistory::create($validatedData);
            DB::table('parking_lots')->where('lot_number', $lot_number)->update([
                'curr_status' => 1,
                'occupied_by' => $user_id,
                'license_plate' => $car->license_plate,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withErrors(['error' => 'Transaction failed. Please try again.']);
        }


        return redirect()->route('profile.active_parking', $user_id);
    }

    public function userIsAlreadyParked($user_id, $start_parking, $end_parking): bool
    {
        // Controllo se l'utente ha un altro parcheggio che si sovrappone
        $existingParking = ParkingLot::where('occupied_by', $user_id)->exists();

        if ($existingParking) {
            // Se esiste un parcheggio che si sovrappone, l'utente non può parcheggiare
            return true;
        }
        return false;
    }

    public function parkingIsOccuped($lot_number): bool {
        $is_occupied = DB::table('parking_lots')->where('lot_number', $lot_number)->value('curr_status');
        return $is_occupied === 1;
    }

    public function update($lot_number): RedirectResponse
    {
        $now = Carbon::now()->timezone('Europe/Rome');

        try {
            $history = DB::table('parking_lot_histories')
                ->where('lot_number', $lot_number)
                ->orderByDesc('created_at')
                ->first();

            if (!$history) {
                return back()->withErrors(['error' => "No parking history found for the given lot."]);
            }

            DB::table('parking_lots')->where('lot_number', $lot_number)->update([
                'curr_status' => 0,
                'occupied_by' => null,
                'license_plate' => null,
            ]);

            DB::table('parking_lot_histories')->where('id', $history->id)->update(['end_parking' => $now]);

        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return back()->withErrors(['error' => "Invalid Lot Number!"]);
        }

        return redirect('/');
    }
}
