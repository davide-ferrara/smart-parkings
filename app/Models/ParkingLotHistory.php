<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingLotHistory extends Model
{
    protected $fillable = [
        'user_id',
        'lot_number',
        'start_parking',
        'end_parking',
    ];
}
