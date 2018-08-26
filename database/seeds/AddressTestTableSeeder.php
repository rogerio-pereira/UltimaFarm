<?php

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Address::class, 2)->create([
            'address_category_id' => 1,
        ]);
    }
}
