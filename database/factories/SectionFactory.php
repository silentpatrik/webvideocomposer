<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Section::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->text,
            'page_id' => \App\Models\Page::factory(),
        ];
    }
}
