<?php

namespace Database\Factories;

use App\Enums\OrganizationStatusEnum;
use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::factory()->create();
        $user->assignRole(RolesEnum::ORGANIZATION->value);
        return [
            'user_id' => $user->id,
            'name' => $this->faker->company,
            'logo' => $this->faker->imageUrl,
            'intro_text' => $this->faker->text(300),
            'status' => OrganizationStatusEnum::ACTIVE->value
        ];
    }
}
