<?php

namespace Database\Factories;

use App\Models\Books;
use Illuminate\Database\Eloquent\Factories\Factory;

class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     *
     * @return array
     */

    protected $model = Books::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'author' => $this->faker->name(),
            'category' => $this->faker->randomDigit,
            'code' => $this->faker->unique()->company,
            'type' => $this->faker->randomElement(array(1, 2)),
            'length' => $this->faker->randomFloat,
        ];
    }
}
