<?php

namespace WebVideo\Database\Seeders;

use Illuminate\Database\Seeder;
use WebVideo\Models\RenderPipeline;

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
