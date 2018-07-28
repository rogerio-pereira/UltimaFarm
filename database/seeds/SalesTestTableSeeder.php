<?php

use App\Models\Sale;
use Illuminate\Database\Seeder;

class SalesTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=50; $i++)
            factory(Sale::class)->create(['client_id' => $i]);
    }
}
