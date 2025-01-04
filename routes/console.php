<?php

use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

//Artisan::command('inspire', function () {
//    $this->comment(Inspiring::quote());
//})->purpose('Display an inspiring quote')->everySixHours();

Artisan::command('log:clear', function () {
    exec('echo "" > ' . storage_path('logs/laravel.log'));
    $this->comment('Logs have been cleared');
})->purpose('Clear logs');

function checkParkingLotStatus($parkingLotHistory) {

    $now = Carbon::now()->setTimezone('Europe/Rome');
    $endParking = $parkingLotHistory->end_parking;
    $lotNumber = $parkingLotHistory->lot_number;

    Log::info("Checking: now at: " . $now . " end at:" . $endParking . " lot: " . $lotNumber);

    // Se il parcheggio e' scaduto
    if ($now > $endParking) {
        DB::beginTransaction();
        try {
            DB::table('parking_lots')->where('lot_number', $lotNumber)->update([
                "curr_status" => 0, "occupied_by" => null, "license_plate" => null
            ]);

            DB::table('parking_lot_histories')->where('id', $parkingLotHistory->id)->update([
                'processed' => true,
                'processed_at' => $now,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error updating parking lot status: " . $e->getMessage());
        }
    }


}

Artisan::command('updateParkingStatusJob', function () {

    $parkingLotHistories = DB::table('parking_lot_histories')->where('processed', false)->get();

    foreach ($parkingLotHistories as $parkingLotHistory) {
        checkParkingLotStatus($parkingLotHistory);
    }

})->purpose('Update the parking status inside the DB')->everyTenSeconds();

Schedule::command('updateParkingStatusJob');
