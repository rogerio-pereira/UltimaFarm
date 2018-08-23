<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(SocialMediaTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(FaqTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(VideoTableSeeder::class);
        $this->call(AddressCategoryTableSeeder::class);
        $this->call(AddressTableSeeder::class);

        //Testes
        if(env('APP_ENV') == 'local') {
            $this->call(ClientsTestTableSeeder::class);
            $this->call(SalesTestTableSeeder::class);
            $this->call(PostTestTableSeeder::class);
            $this->call(DepoimentTestTableSeeder::class);
            $this->call(AddressTestTableSeeder::class);
        }
    }
}
