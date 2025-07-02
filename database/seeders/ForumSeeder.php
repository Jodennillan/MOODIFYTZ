<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ForumPost;
use App\Models\ForumReply;
use App\Models\ForumLike;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure you have some users
        $users = User::factory()->count(5)->create();

        // Sample tags
        $tags = ['Anxiety', 'Sleep', 'Relationships', 'Spirituality', 'Loneliness', 'Confidence'];

        // Create 10 forum posts
        ForumPost::factory(10)->create()->each(function ($post) use ($users, $tags) {
            // Attach random tags
            $post->tags = collect($tags)->random(rand(1, 3))->values()->toArray();
            $post->save();

            // Add random replies
            ForumReply::factory(rand(1, 5))->create([
                'forum_post_id' => $post->id,
                'user_id' => $users->random()->id,
            ]);

            // Add some likes
            foreach ($users->random(rand(1, 3)) as $user) {
                ForumLike::create([
                    'forum_post_id' => $post->id,
                    'user_id' => $user->id,
                ]);
            }
        });
    }
}
