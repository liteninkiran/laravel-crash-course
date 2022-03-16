<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $post = Post::inRandomOrder()->first();
        $user = User::whereDoesntHave('likes', function (Builder $query) use($post) {
            $query->where('post_id', '=', $post->id);
        })->inRandomOrder()->first();

        return [
            'post_id' => $post->id,
            'user_id' => $user->id,
        ];
    }
}
