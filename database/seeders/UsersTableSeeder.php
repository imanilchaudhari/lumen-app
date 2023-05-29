<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Anil Chaudhari',
            'email' => 'imanilchaudhari@gmail.com',
            'password' => Hash::make('123456'),
            'api_token' => Str::random(64),
        ]);

        User::factory()
            ->count(10)
            ->create();
    }
}
