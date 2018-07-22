<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Rogério Eduardo Pereira',
            'email' => 'rogerio@colmeiatecnologia.com.br',
            'password' => '$2y$10$sbyaGhD6rG8MY1g4FArA/Oo9fsOMX/M1CN88cLO4HnUkJ3SgGpnue', 
            'role' => 'Administrador',
            'remember_token' => str_random(10),
            'active' => true,
        ]);
    }
}
