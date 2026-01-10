<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    /** @use HasFactory<\Database\Factories\RegistrationFactory> */
    use HasFactory, HasUlids;

    public $fillable = [
        'user_id',
        'payment_id',
        'check_in',
        'check_in_at',
    ];

    protected $casts = [
        'check_in' => 'boolean',
        'check_in_at' => 'datetime',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function payment(): BelongsTo {
        return $this->belongsTo(Payment::class);
    }
}
