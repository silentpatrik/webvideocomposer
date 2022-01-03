<?php

namespace WebVideo\Database\Seeders;

use Illuminate\Database\Seeder;
use WebVideo\Models\Argument;

class ArgumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Argument::factory()
            ->count(5)
            ->create();
    }
}
