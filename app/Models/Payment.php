<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
