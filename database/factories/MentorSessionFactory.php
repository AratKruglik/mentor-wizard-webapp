<?php

namespace Database\Factories;

use App\Models\MentorSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MentorSession>
 */
class MentorSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date'=> fake()->dateTimeBetween('now', '+3 month'),
            'is_success' => fake()->boolean(),
            'is_paid' => fake()->boolean(),
            'is_cancelled' => fake()->boolean(),
            'is_date_changed' => fake()->boolean(),
            'cost' => fake()->randomFloat(2, 10, 1000),
        ];
    }

    /**
     * Configure the factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (MentorSession $mentorSession) {
            if (!$mentorSession->mentor_id ) {
                $mentorSession->mentor()->associate(User::factory()->create());
            }
            if (!$mentorSession->menti_id) {
                $mentorSession->menti()->associate(User::factory()->create());
            }

            $mentorSession->save();
        });
    }
}
