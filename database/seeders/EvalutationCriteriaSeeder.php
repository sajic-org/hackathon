<?php

namespace Database\Seeders;

use App\Models\EvalutationCriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvalutationCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EvalutationCriteria::factory(5)->create();
    }
}
