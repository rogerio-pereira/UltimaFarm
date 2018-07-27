<?php

use App\Models\Client;
use App\Models\User;
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
        factory(User::class, 50)->create(['role' => 'Cliente'])->each(function ($u) {
            $u->client()->save(
                factory(Client::class)->make(['user_id' => $u->id])
            );
        });
    }
}
