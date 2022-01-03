<?php

namespace WebVideo\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use WebVideo\Models\Project;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

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
            'user_id' => User::factory(),
        ];
    }
}
