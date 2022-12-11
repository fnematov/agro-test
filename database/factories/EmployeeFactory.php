<?php

namespace Database\Factories;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        $user = User::factory()->create();
        $user->assignRole(RolesEnum::EMPLOYEE->value);
        return [
            'user_id' => $user->id,
            'full_name' => $this->faker->name,
            'phone_number' => $this->faker->numberBetween(710000101, 999998899)
        ];
    }
}
