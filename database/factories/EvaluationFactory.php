<?php

namespace Database\Factories;

use App\Models\EvalutationCriteria;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluation>
 */
class EvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => Team::factory(),
            'user_id' => User::factory(),
            'evaluation_criteria_id' => EvalutationCriteria::factory(),
            'score' => $this->faker->randomFloat(1, 0, 10),
        ];
    }
}
