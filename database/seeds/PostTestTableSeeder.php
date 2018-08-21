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

        factory(PostCategory::class)->create();

        factory(Post::class)->create([
            'title' => 'Um mercado seguro: invista em Cannabis Medicinal (TESTE)',
            'image' => env('APP_URL').'/img/blog-1.png', 
            'post_category_id' => 6,
        ]);

        factory(Post::class)->create([
            'title' => 'Você conhece o mercado da Cannabis Medicinal (TESTE)',
            'image' => env('APP_URL').'/img/blog-2.png', 
            'post_category_id' => 6,
        ]);

        factory(Post::class)->create([
            'title' => 'Como investir em commodities no mercado americano (TESTE)',
            'image' => env('APP_URL').'/img/blog-3.png', 
            'post_category_id' => 6,
        ]);
    }
}
