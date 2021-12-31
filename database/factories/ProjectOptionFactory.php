<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ProjectOption;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'project_id' => \App\Models\Project::factory(),
        ];
    }
}
