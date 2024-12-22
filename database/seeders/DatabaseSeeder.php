<?php

namespace Database\Seeders;

use App\Models\ParkingLot;
use App\Models\ParkingLotZone;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

    }
}
