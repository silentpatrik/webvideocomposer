<?php

namespace WebVideo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use WebVideo\Models\Page;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug,
        ];
    }
}
