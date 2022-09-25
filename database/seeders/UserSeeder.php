<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'nome' => 'Everton Henrique',
            'email' => 'everton@everton.com',
            'senha' => bcrypt('123456789'),
            'cargo' => 'Administrador',
        ]);
        User::factory(5)->create();
    }
}
