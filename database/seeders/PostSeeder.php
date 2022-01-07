<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    const SAMPLE_TEXT = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Integer pretium ligula id risus rhoncus faucibus.
    Fusce imperdiet, risus ultrices vehicula varius, sem purus mattis odio, vel ullamcorper mi neque quis tellus.
    Fusce aliquam vel odio ac ullamcorper. Vestibulum pulvinar enim non feugiat efficitur.
    Ut congue, mi sit amet fermentum imperdiet, elit leo tempus ipsum, ac imperdiet justo diam ac metus.
    Maecenas vitae ullamcorper velit. Vivamus ut augue commodo, iaculis odio et, imperdiet nunc.
    Fusce hendrerit ligula sit amet sem accumsan, eu interdum augue pharetra. Suspendisse potenti.
    In hac habitasse platea dictumst. Proin bibendum vitae nisi vel dapibus.";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 random posts
        for ($i = 0; $i < 10; $i++) {
            DB::table('posts')->insert([
                'name' => Str::random(10),
                'content' => self::SAMPLE_TEXT,
                'user_id' => 1,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]);
        }

        DB::table('posts')->insert([
            'name' => 'Markdown features',
            'content' => file_get_contents(base_path().'/database/seeders/markdown.txt'),
            'user_id' => 1,
            'created_at' => (new \DateTime())->add(new \DateInterval('PT1S')),
            'updated_at' => (new \DateTime())->add(new \DateInterval('PT1S')),
        ]);
    }
}
