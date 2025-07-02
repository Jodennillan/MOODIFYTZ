<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ForumReply>
 */
class ForumReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'body' => fake()->sentence(10),
        'user_id' => \App\Models\User::inRandomOrder()->first()?->id ?? 1,
        'forum_post_id' => \App\Models\ForumPost::inRandomOrder()->first()?->id ?? 1,
    ];
}

}
