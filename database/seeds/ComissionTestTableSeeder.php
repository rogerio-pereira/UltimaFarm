<?php

use App\Models\Comission;
use Illuminate\Database\Seeder;

class ComissionTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=2; $i<=47; $i++){
            //A subtração é para o cliente nao receber a comissao de sua propria venda
            factory(Comission::class)->create(['sale_id' => 52-$i, 'client_id' => $i]);
        }
        
        factory(Comission::class)->create(['client_id' => 51, 'sale_id' => 50]);
        factory(Comission::class)->create(['client_id' => 51, 'sale_id' => 49]);
        factory(Comission::class)->create(['client_id' => 51, 'sale_id' => 48]);
    }
}
