<?php

namespace database\seeders;

use Illuminate\Database\Seeder;
use WebVideo\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::factory()
            ->count(5)
            ->create();
    }
}
