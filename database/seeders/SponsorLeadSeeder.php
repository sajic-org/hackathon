<?php

namespace Database\Seeders;

use App\Models\SponsorLead;
use Illuminate\Database\Seeder;

class SponsorLeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SponsorLead::factory(50)->create();
    }
}
