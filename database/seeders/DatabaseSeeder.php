<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\staff;
use Illuminate\Database\Seeder;
use App\Models\staff_attendance;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        staff::factory(10)->create();
        staff_attendance::factory(10)->create();


      

        // staff_attendance::factory()->create([
        //     'staff_id'=> fake()->randomElement(['1', '2', '3', '4','5', '6', '7', '8', '9', '10']),
        //     'attendance_date' => fake()->date(),
        //     'status' => fake()->randomElement(['present', 'absent', 'late']),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
