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
        factory(Invoice::class, 5)->create(['client_id' => 51]);
    }
}
