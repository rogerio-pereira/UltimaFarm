<?php

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class SocialMediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SocialMedia::class)->create([
            'name' => 'Facebook',
            'url' => null,
            'icon' => '<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span>',
            'active' => 0,
        ]);

        factory(SocialMedia::class)->create([
            'name' => 'Instagram',
            'url' => null,
            'icon' => '<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-instagram fa-stack-1x fa-inverse"></i></span>',
            'active' => 0,
        ]);

        factory(SocialMedia::class)->create([
            'name' => 'Pinterest',
            'url' => null,
            'icon' => '<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-pinterest-p fa-stack-1x fa-inverse"></i></span>',
            'active' => 0,
        ]);

        factory(SocialMedia::class)->create([
            'name' => 'Twitter',
            'url' => null,
            'icon' => '<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span>',
            'active' => 0,
        ]);

        factory(SocialMedia::class)->create([
            'name' => 'Youtube',
            'url' => null,
            'icon' => '<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-youtube fa-stack-1x fa-inverse"></i></span>',
            'active' => 0,
        ]);

        factory(SocialMedia::class)->create([
            'name' => 'Linkedin',
            'url' => null,
            'icon' => '<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x fa-inverse"></i></span>',
            'active' => 0,
        ]);

        factory(SocialMedia::class)->create([
            'name' => 'Google+',
            'url' => null,
            'icon' => '<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x fa-inverse"></i></span>',
            'active' => 0,
        ]);
    }
}
