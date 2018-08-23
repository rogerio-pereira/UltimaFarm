<?php

use App\Models\Email;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class EmailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Email::class)->create([
            'email' => 'contato@ultimatefarmcannabiscenter.com.br',
            'active' => 1,
        ]);
    }
}
