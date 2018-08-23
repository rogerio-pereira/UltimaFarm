<?php

use App\Models\Telephone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class TelephoneTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Telephone::class)->create([
            'address_category_id' => 1,
            'description' => 'Capitais e regiões metropolitanas',
            'telephone' => '4004-0000',
            'whatsapp' => 0,
            'active' => 1,
        ]);

        factory(Telephone::class)->create([
            'address_category_id' => 1,
            'description' => 'Demais regiões',
            'telephone' => '4004-0000',
            'whatsapp' => 0,
            'active' => 1,
        ]);
    }
}
