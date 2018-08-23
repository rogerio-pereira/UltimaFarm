<?php

use App\Models\BusinessInfo;
use Illuminate\Database\Seeder;

class BusinessInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(BusinessInfo::class)->create([
            'companyName' => 'Ultimate Farm Cannabis Center',
            'cnpj' => '00.000.000/0000-00',
        ]);
    }
}
