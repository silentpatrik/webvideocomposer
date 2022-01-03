<?php

namespace WebVideo\Database\Seeders;

use Illuminate\Database\Seeder;
use WebVideo\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::factory()
            ->count(5)
            ->create();
    }
}
