<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Car extends Model
{
    protected $fillable = [
        'model_name',
        'license_plate',
    ];
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'car_user');
    }
}
