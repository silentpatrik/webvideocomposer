<?php

namespace Database\Seeders;

use App\Models\RenderPipeline;
use Illuminate\Database\Seeder;

class RenderPipelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RenderPipeline::factory()
            ->count(5)
            ->create();
    }
}
