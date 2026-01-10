<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    public $fillable = [
        'amount',
        'status',
        'transaction_id',
    ];

    protected $casts = [
        'status' => PaymentStatus::class,
    ];

    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class);
    }

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, Registration::class);
    }
}
