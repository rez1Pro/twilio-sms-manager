<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SendMessage>
 */
class SendMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender' => fake()->phoneNumber(),
            'receiver' => fake()->phoneNumber(),
            'message' => fake()->sentence(),
            'status' => fake()->randomElement(['Delivered', 'Pending', 'Failed', 'Sent']),
            'delivered_at' => now(),
        ];
    }
}
