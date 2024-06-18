<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donate>
 */
class DonateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'donated_user_id' => \App\Models\User::factory(),
            'donating_user_id' => \App\Models\User::factory(),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'message' => $this->faker->text(),
        ];
    }
}
