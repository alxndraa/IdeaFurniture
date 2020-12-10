<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234'),
            'address' => 'Kav 21, Alam Sutera Jalan Jalur Sutera Barat',
            'gender' => 'female',
            'dob' => '2000-12-12',
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);
    }
}
