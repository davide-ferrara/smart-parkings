<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLotZone extends Model
{
    /** @use HasFactory<\Database\Factories\ParkingLotZoneFactory> */
    use HasFactory;

    protected $fillable = [
        'letter',
        'price_per_hours',
    ];


}
