<?php

namespace Database\Factories;

use App\Models\Command;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Command::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'executable' => $this->faker->text(255),
            'title' => $this->faker->sentence(10),
            'parallel' => '1',
            'enabled' => '1',
            'render_pipeline_id' => \App\Models\RenderPipeline::factory(),
        ];
    }
}
