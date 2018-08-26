<?php

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Address::class)->create([
            'address_category_id' => 2,
            'street' => 'Oconnor dr',
            'number' => 7711,
            'complement' => 'Suite 1002',
            'zipcode' => '78681',
            'neighborhood' => '',
            'city' => 'Round Rock',
            'state' => 'TX',
        ]);
    }
}
