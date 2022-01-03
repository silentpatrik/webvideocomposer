<?php

namespace WebVideo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use WebVideo\Models\RenderPipeline;

class RenderPipelineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RenderPipeline::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
        ];
    }
}
