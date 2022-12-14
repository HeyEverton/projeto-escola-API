<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

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
            'name' => 'Everton Henrique',
            'email' => 'everton@everton.com',
            'password' => bcrypt('123456789'),
            'role' => 'Admin',
            'profile_photo' => Uuid::uuid6() . '.jpg',
        ]);
        User::factory(3)->create();
    }
}
