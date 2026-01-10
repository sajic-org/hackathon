<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluation extends Model
{
    /** @use HasFactory<\Database\Factories\EvaluationFactory> */
    use HasFactory;

    public $fillable = [
        'team_id',
        'user_id',
        'criteria_id',
        'score',
    ];

    protected $casts = [
        'score' => 'decimal:3,1'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsTo{
        return $this->belongsTo(Team::class);
    }

    public function criteria(): BelongsTo{
        return $this->belongsTo(Criteria::class);
    }
}
