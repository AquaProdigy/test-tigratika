<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemChild>
 */
class ItemChildFactory extends Factory
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
            'item_id' => Item::factory(),
            'laser' => $this->faker->numberBetween(100, 1000),
            'weld' => $this->faker->numberBetween(100, 1000),
            'assembly' => $this->faker->numberBetween(100, 1000),
            'electric' => $this->faker->numberBetween(100, 1000)
        ];
    }
}
