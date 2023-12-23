<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\staff_attendance>
 */
class StaffAttendanceFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'staff_id'=> fake()->randomElement(['1', '2', '3', '4','5', '6', '7', '8', '9', '10']),
            'attendance_date' => fake()->date(),
            'status' => fake()->randomElement(['present', 'absent', 'late']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
