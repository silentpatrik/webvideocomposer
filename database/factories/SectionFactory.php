<?php

namespace WebVideo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use WebVideo\Models\Page;
use WebVideo\Models\Section;

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
            'page_id' => Page::factory(),
        ];
    }
}
