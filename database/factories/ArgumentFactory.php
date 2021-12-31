<?php

namespace Database\Factories;

use App\Models\Argument;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'command_id' => \App\Models\Command::factory(),
        ];
    }
}
