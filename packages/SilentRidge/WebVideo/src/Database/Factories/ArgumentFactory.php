<?php

namespace WebVideo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use WebVideo\Models\Argument;
use WebVideo\Models\Command;

class ArgumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Argument::class;

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
            'description' => $this->faker->sentence(15),
            'enabled' => '1',
            'command_id' => Command::factory(),
        ];
    }
}
