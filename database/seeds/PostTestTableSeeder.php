<?php

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class PostTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PostCategory::class, 5)->create()->each(function ($c) {
            $c->posts()->saveMany(
                factory(Post::class, 10)->make()
            );
        });
    }
}
