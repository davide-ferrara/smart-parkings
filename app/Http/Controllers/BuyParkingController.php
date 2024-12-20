<?php

namespace App\Http\Controllers;

use App\Models\ParkingLotHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BuyParkingController extends Controller
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
        ]);
        $start_parking = Carbon::parse($validatedData['start_parking']);
        $end_parking = Carbon::parse($validatedData['end_parking']);
        $user_id = $validatedData['user_id'];
        $lot_number= $validatedData['lot_number'];

        if (self::userIsAlreadyParked($user_id, $start_parking, $end_parking)) {
            return redirect('/active-parking');
        }

        $zone_id = DB::table('parking_lots')->where('lot_number', $lot_number)->value('zone_id');
        $price_per_hours = DB::table('parking_lot_zones')->where('id', $zone_id)->value('price_per_hours');

        $total_price = ($start_parking->diffInMinutes($end_parking) / 60) * $price_per_hours;
        $user_credit = DB::table('user_credits')->where('user_id', $user_id)->value('total');
        $new_credit = $user_credit - $total_price;

        if($new_credit < 0) {
            return back()->withErrors(['error' => 'Insufficient funds.']);
        }

        DB::table('user_credits')->where('user_id', $user_id)->update(['total' => $new_credit]);

        // Inserimento nel database
        ParkingLotHistory::create($validatedData);

        DB::table('parking_lots')
            ->where('lot_number', $validatedData['lot_number'])
            ->update(['curr_status' => 1]);

        return redirect('/active-parking');
    }

    public function userIsAlreadyParked($user_id, $start_parking, $end_parking): bool
    {
        // Controllo se l'utente ha un altro parcheggio che si sovrappone
        $existingParking = ParkingLotHistory::where('user_id', $user_id)
            ->where(function ($query) use ($start_parking, $end_parking) {
                $query->where('start_parking', '<', $end_parking)   // Il parcheggio esistente inizia prima della fine
                    ->where('end_parking', '>', $start_parking);   // Il parcheggio esistente finisce dopo l'inizio
            })
            ->exists();

        if ($existingParking) {
            // Se esiste un parcheggio che si sovrappone, l'utente non può prenotare
            return true;
        }
        return false;
    }

    public function parkingIsOccuped($lot_number): bool {
        $is_occuped = DB::table('parking_lots')->where('lot_number', $lot_number)->value('curr_status');
        return $is_occuped;
    }
}
