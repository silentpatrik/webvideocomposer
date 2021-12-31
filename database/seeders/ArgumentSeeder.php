<?php

namespace Database\Seeders;

use App\Models\Argument;
use Illuminate\Database\Seeder;

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
