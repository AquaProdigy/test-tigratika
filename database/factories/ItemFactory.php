<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'count' => $this->faker->randomDigit(),
            'source' => $this->faker->randomElement(['производство', 'склад']),
            'laser' => $this->faker->numberBetween(100, 1000),
            'weld' => $this->faker->numberBetween(100, 1000),
            'assembly' => $this->faker->numberBetween(100, 1000),
            'electric' => $this->faker->numberBetween(100, 1000)
        ];
    }
}
