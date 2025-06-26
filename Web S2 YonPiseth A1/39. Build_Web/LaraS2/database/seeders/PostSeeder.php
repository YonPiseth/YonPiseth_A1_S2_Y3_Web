<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => 'First Blog Post',
            'body' => 'This is the body of the first blog post.',
        ]);

        Post::create([
            'title' => 'Second Post',
            'body' => 'Another sample blog post content.',
        ]);
    }
}
