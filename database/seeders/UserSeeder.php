<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "nama_pengguna" => "Chasetyo Ivan Yusaga",
            "username" => "ivan20",
            "email" => "ivan@gmail.com",
            "password" => bcrypt('12345'),
        ]);

        User::create([
            "nama_pengguna" => "Alya Wahyuning",
            "username" => "alya93",
            "email" => "alya@gmail.com",
            "password" => bcrypt('12345'),
        ]);
    }
}
