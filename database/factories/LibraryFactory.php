<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class LibraryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'cod' => $this->faker->unique()->numerify(),
            'type' => $this->faker->randomElement(['F', 'D']),
            'weight' => $this->faker->numerify('##') . 'MB',
            'author_id' => Author::factory(),
            'category_id' => Category::factory()
        ];
    }
}
