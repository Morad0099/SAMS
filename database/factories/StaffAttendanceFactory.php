<?php

namespace Database\Factories;

use App\Models\Staff;
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
            // 'staff_id' => function () {
            //     return factory(Staff::class)->create()->id;
            // },
            'attendance_date' => fake()->date(),
            'status' => fake()->randomElement(['present', 'absent', 'late']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
