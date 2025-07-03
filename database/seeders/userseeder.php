<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'nyoman',
            'username' => 'admin1',
            'email' => 'admin@email.com',
            'password' => Hash::make('123'),
        ]);

        
    }
}
