<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'license_plate',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
