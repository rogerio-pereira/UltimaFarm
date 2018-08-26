<?php

use App\Models\AddressCategory;
use Illuminate\Database\Seeder;

class AddressCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AddressCategory::class)->create(['name' => 'Brasil']);
        factory(AddressCategory::class)->create(['name' => 'Texas']);
    }
}
