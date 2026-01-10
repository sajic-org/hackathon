<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkedIn = fake()->boolean(70); // 70% chance of being checked in

        return [
            'user_id' => User::factory(),
            'payment_id' => Payment::factory(),
            'checked_in' => $checkedIn,
            'check_in_at' => $checkedIn ? fake()->dateTimeBetween('-1 month', 'now') : null,
        ];
    }
}
