<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCredit extends Model
{
    /** @use HasFactory<\Database\Factories\UserCreditFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'credit',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
