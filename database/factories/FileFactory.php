<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fileable_type' => $this->faker->randomElement([
                \App\Models\Project::class,
            ]),
            'fileable_id' => function (array $item) {
                return app($item['fileable_type'])->factory();
            },
        ];
    }
}
