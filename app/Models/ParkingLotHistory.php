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

    // Questi attributi verranno automaticamente convertiti in oggetti Carbon
    protected $casts = [
        'start_parking' => 'datetime',
        'end_parking' => 'datetime',
        'processed_at' => 'datetime',
        'processed' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
