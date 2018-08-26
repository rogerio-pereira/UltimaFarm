<?php

use App\Models\Telephone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class TelephoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Telephone::class)->create([
            'address_category_id' => 2,
            'description' => null,
            'telephone' => '(512) 981-3518',
            'whatsapp' => 0,
            'active' => 1,
        ]);

        factory(Telephone::class)->create([
            'address_category_id' => 2,
            'description' => null,
            'telephone' => '(512) 947-4575',
            'whatsapp' => 0,
            'active' => 1,
        ]);
    }
}
