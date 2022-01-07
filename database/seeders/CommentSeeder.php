<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add random comment to every post
        $posts = Post::all();
        foreach ($posts as $post) {
            DB::table('comments')->insert([
                'author' => Str::random(10),
                'content' => Str::random(20),
                'post_id' => $post->id,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]);
        }
    }
}
