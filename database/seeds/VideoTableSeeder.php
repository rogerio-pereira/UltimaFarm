<?php

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Video::class)->create([
            'title' => 'A maturidade do Mercado Americano',
            'description' => '<p>Ao se tornar um investidor da Ultimate Farm, você passa a ter rendimentos mensais que podem ser resgatados a cada 6 meses.</p>',
            'url' => 'https://www.youtube.com/watch?v=ljwij-EnmWg',
            'image' => 'http://img.youtube.com/vi/ljwij-EnmWg/0.jpg',
            'active' => true
        ]);
    }
}
