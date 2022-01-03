<?php

namespace WebVideo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use WebVideo\Models\File;
use WebVideo\Models\Project;
use function app;

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
                Project::class,
            ]),
            'fileable_id' => function (array $item) {
                return app($item['fileable_type'])->factory();
            },
        ];
    }
}
