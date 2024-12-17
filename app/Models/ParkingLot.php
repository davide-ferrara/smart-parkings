<?php

namespace App\Models;

use Database\Factories\ParkingLotFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLot extends Model
{
    /** @use HasFactory<ParkingLotFactory> */
    use HasFactory;

    protected $fillable = [
        'lat',
        'lng',
        'lot_number',
        'address',
        'curr_status',
        'zone'
    ];

}
