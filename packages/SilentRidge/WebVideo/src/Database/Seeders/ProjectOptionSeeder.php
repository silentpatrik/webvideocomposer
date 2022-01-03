<?php

namespace WebVideo\Database\Seeders;

use Illuminate\Database\Seeder;
use WebVideo\Models\ProjectOption;

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
