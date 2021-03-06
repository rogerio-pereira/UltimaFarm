<?php

use App\Models\Client;
use App\Models\Comission;
use App\Models\Sale;
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
                factory(Client::class)->make(['user_id' => $u->id, 'hashIndication' => md5($u->email)])
            );
        });

        factory(User::class, 1)->create([
            'name' => 'Sandbox',
            'email' => 'sandbox@colmeiatecnologia.com.br',
            'password' => bcrypt('123'),
            'role' => 'Cliente'
        ])->each(function ($u) {
            $u->client()->save(
                factory(Client::class)->make([
                    'user_id' => $u->id,
                    'hashIndication' => md5($u->email),
                    'telephone' => '(35) 99109-0906',
                    'document' => '10104234601',
                    'street' => 'Rua Aristides Thomaz Ballerini',
                    'number' => 175,
                    'complement' => null,
                    'zipcode' => '37704206',
                    'neighborhood' => 'Jardim Ipê',
                    'city' => 'Poços de Caldas',
                    'state' => 'MG',
                ])
            );
        });
        factory(Sale::class)->create(['client_id' => 51]);


        factory(User::class, 1)->create([
            'name' => 'Indicacao',
            'email' => 'indicacao@colmeiatecnologia.com.br',
            'password' => bcrypt('123'),
            'role' => 'Cliente'
        ])->each(function ($u) {
            $u->client()->save(
                factory(Client::class)->make([
                    'user_id' => $u->id,
                    'hashIndication' => md5($u->email),
                    'indication_id' => 51
                ])
            );
        });
    }
}
