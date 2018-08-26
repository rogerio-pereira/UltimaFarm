<?php

use App\Models\Depoiment;
use Illuminate\Database\Seeder;

class DepoimentTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Depoiment::class, 10)->create();
    }
}
