<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->creditCardType(),
            'duration' => fake()->dayOfMonth(),
            'notice_number' => fake()->randomNumber(),
            'required_duration' => fake()->date(),
            'from_date' => fake()->dateTimeBetween('+ 15 days',"+ 21 days"),
            'start_date' => fake()->dateTimeBetween('- 5 days',"+ 15 days"),
            'employee_id' => 104,
        ];
    }
}
