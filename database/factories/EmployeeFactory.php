<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
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
            'work_id_number' => fake()->uuid(),
            'civil_id_number' => fake()->uuid(),
            'job_title' => fake()->jobTitle(),
            'phone' => fake()->phoneNumber(),
            'department' => fake()->streetName(),
            'management' => fake()->streetName(),
            'appointment_date' => fake()->date(),
        ];
    }
}
