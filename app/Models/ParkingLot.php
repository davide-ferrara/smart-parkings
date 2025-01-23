<?php

namespace App\Models;

use Database\Factories\ParkingLotFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static ParkingLot create(array $attributes = [])
 */
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
        'zone_id',
        'occupied_by',
        'license_plate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'occupied_by');
    }

}
