<?php

use App\Models\PageCategory;
use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PageCategory::class)->create([
            'title' => 'Home',
        ]);

        factory(PageCategory::class)->create([
            'title' => 'Empresa',
        ]);

        factory(PageCategory::class)->create([
            'title' => 'Investimentos',
        ]);
    }
}
