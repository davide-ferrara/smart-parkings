<?php

use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

//Artisan::command('inspire', function () {
//    $this->comment(Inspiring::quote());
//})->purpose('Display an inspiring quote')->everySixHours();

function checkParkingLotStatus($parkingLotHistory) {

    $now = Carbon::now()->setTimezone('Europe/Rome');
    $endParking = $parkingLotHistory->end_parking;
    $lotNumber = $parkingLotHistory->lot_number;

    Log::info("Checking: now at: " . $now . " end at:" . $endParking . " lot: " . $lotNumber);

    if ($now > $endParking) {
        Log::info("Found an expired parking lot " . $lotNumber);
        DB::table('parking_lots')->where('lot_number', $lotNumber)->update([
            "curr_status" => 0
        ]);
    } else if($endParking > $now) {
        Log::info("Parking lot " . $parkingLotHistory->lot_number . " still valid!" );
    } else {
        Log::info("Found old parking history");
    }

}

Artisan::command('updateParkingStatusJob', function () {

    $parkingLotHistories = DB::table('parking_lot_histories')->get();

    foreach ($parkingLotHistories as $parkingLotHistory) {
        checkParkingLotStatus($parkingLotHistory);
    }

})->purpose('Update the parking status inside the DB')->everyTenSeconds();

Schedule::command('updateParkingStatusJob');
