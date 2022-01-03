<?php

namespace WebVideo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use WebVideo\Models\Command;
use WebVideo\Models\RenderPipeline;

class CommandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Command::class;
    protected $states;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'executable' => $this->faker->randomElement(['']),

            'title' => $this->faker->sentence(10),
            'parallel' => '1',
            'enabled' => '1',
            'render_pipeline_id' => RenderPipeline::factory(),
        ];
    }

    public function configure()
    {
        return $this->sequence(
            [
                'published' => now()
            ], [
                'published' => null
            ]
        );
    }

    public function run()
    {
        BlogPost::factory()
            ->count(6)
            ->sequence(
                ['published' => now()],
                ['published' => null]
            )
            ->create();
    }
}
