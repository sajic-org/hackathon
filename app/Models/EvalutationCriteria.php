<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EvalutationCriteria extends Model
{
    /** @use HasFactory<\Database\Factories\EvalutationCriteriaFactory> */
    use HasFactory;

    public $fillable = [
        'name',
        'weight',
    ];

    protected $casts = [
        'weight' => 'decimal:2,1',
    ];

    public function evaluations(): HasMany{
        return $this->hasMany(Evaluation::class);
    }
}
