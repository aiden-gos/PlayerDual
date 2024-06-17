<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ordering_user_id' => \App\Models\User::factory(),
            'ordered_user_id' => \App\Models\User::factory(),
            'message' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['pending', 'completed', 'rejected']),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'duration' => $this->faker->numberBetween(1, 10),
            'total_price' => $this->faker->randomFloat(2, 1, 1000),
            'start_at' => $this->faker->dateTimeBetween('-1 hour', '+1 hour'),
            'end_at' => $this->faker->dateTimeBetween('+1 hour', '+2 hour'),

        ];
    }
}
