<?php

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Client::class, 50)->create();
    }
}
