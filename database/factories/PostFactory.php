<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $body = '';

        $paragraphs = $this->faker->paragraphs(rand(2, 6));
        $created_at = $this->faker->dateTimeBetween('-1 year', 'now');

        foreach ($paragraphs as $paragraph) {
            $body .= "<p>{$paragraph}</p>";
        }

        return [
            'body' => $body,
            'user_id' => $user->id,
            'created_at' => $created_at,
        ];
    }
}
