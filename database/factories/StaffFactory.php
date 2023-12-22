<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'course' => fake()->word(), // Modify as needed
            'class' => fake()->word(),  // Modify as needed
            'phone' => fake()->phoneNumber(),
            'gender' => fake()->randomElement(['male', 'female']),
            'designation' => fake()->word(), // Modify as needed
            'employee_id' => Str::random(10), // You might want to use a more meaningful employee ID logic
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
