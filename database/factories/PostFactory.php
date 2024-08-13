<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->all(); // Get all user IDs

        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->text,
            'image' => $this->faker->imageUrl,
            'user_id' => $this->faker->randomElement($userIds), // Random user ID
        ];
    }
}
