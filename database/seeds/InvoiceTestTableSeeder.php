<?php

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Invoice::class)->create([
            'client_id' => 51,
            'product_id' => 2,
            'value' => 1000,
            'profitability' => 10.00,
            'deadline' => '2019-02-25 21:22:06',
            'refundValue' => 1600,
            'token' => 'EC-5S1035530N6355456',
            'payerID' => 'KZR8R737WT7ZJ',
        ]);
        
        factory(Invoice::class)->create([
            'client_id' => 51,
            'product_id' => 2,
            'value' => 1000,
            'profitability' => 10.00,
            'deadline' => '2019-02-25 21:22:06',
            'refundValue' => 1600,
            'token' => 'EC-44Y95703W3546800D',
            'payerID' => 'KZR8R737WT7ZJ',
        ]);
        
        factory(Invoice::class)->create([
            'client_id' => 52,
            'product_id' => 3,
            'value' => 5000,
            'profitability' => 15.00,
            'deadline' => '2019-02-25 22:22:03',
            'refundValue' => 9500,
            'token' => 'EC-0GD96435FB3835639',
            'payerID' => 'KZR8R737WT7ZJ',
        ]);
    }
}
