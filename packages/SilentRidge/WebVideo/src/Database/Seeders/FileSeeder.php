<?php

namespace WebVideo\Database\Seeders;

use Illuminate\Database\Seeder;
use WebVideo\Models\File;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::factory()
            ->count(5)
            ->create();
    }
}
