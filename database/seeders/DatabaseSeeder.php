<?php

namespace Database\Seeders;

use App\Models\ParkingLotZone;
use App\Providers\Models\ParkingLot;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $parkingZones = [
            ['letter' => 'A', 'price_per_hours' => 2],
            ['letter' => 'B', 'price_per_hours' => 1],
            ['letter' => 'C', 'price_per_hours' => 0.5],
        ];

        for($i = 0; $i < count($parkingZones); $i++) {
            ParkingLotZone::factory()->create(
                $parkingZones[$i]
            );
        }

        Log::info("Seeding database, adding parking lots...");

        $parkingLotsSeedPath = "parking_lots.json";
        $jsonContent = file_get_contents($parkingLotsSeedPath);
        $jsonContent = json_decode($jsonContent, true);

        $parkingLotSeed = $jsonContent[2]["data"];

        for($i = 0; $i < count($parkingLotSeed); $i++) {
            ParkingLot::factory()->create($parkingLotSeed[$i]);
        }

    }
}
