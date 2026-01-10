<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalutationCriteria extends Model
{
    /** @use HasFactory<\Database\Factories\EvalutationCriteriaFactory> */
    use HasFactory;

    public $fillable = [
        'name',
        'score',
    ];
}
