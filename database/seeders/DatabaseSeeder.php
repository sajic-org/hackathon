<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'role' => UserRoles::USER,
        ]);
        User::factory()->create([
            'name' => 'Test Appraiser',
            'email' => 'appraiser@example.com',
            'role' => UserRoles::APPRAISER,
        ]);
        User::factory()->create([
            'name' => 'Test commission',
            'email' => 'commission@example.com',
            'role' => UserRoles::COMMISSION,
        ]);
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'role' => UserRoles::ADMIN,
        ]);

        $this->call([
            SponsorLeadSeeder::class,
            PaymentSeeder::class,
            RegistrationSeeder::class,
            PostSeeder::class,
            TeamSeeder::class,
        ]);
    }
}
