<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'avatar' => fake()->imageUrl(),
            'linkedin' => fake()->url,
            'telegram' => fake()->userName,
            'whatsapp' => fake()->phoneNumber,
            'phone' => fake()->phoneNumber,
            'description' => fake()->text(),
        ];
    }
}
