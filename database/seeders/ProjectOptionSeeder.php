<?php

namespace Database\Seeders;

use App\Models\ProjectOption;
use Illuminate\Database\Seeder;

class ProjectOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectOption::factory()
            ->count(5)
            ->create();
    }
}
