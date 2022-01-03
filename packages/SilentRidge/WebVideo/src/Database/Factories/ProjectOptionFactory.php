<?php

namespace WebVideo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use WebVideo\Models\Project;
use WebVideo\Models\ProjectOption;

class ProjectOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectOption::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'value' => $this->faker->text(255),
            'settings' => [],
            'description' => $this->faker->sentence(15),
            'project_id' => Project::factory(),
        ];
    }
}
