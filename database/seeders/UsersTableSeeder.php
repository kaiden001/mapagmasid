<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([

            // Superdmin
            [
                'name' => 'Superadmin',
                'username' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('Superadmin@123'),
                'role' => 'superadmin',
                'status' => 'active',
            ],
            // Admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Admin@123'),
                'role' => 'admin',
                'status' => 'active',
            ],
            // Enumerator
            [
                'name' => 'Enumerator',
                'username' => 'enumerator',
                'email' => 'enumerator@gmail.com',
                'password' => Hash::make('Enumerator@123'),
                'role' => 'enumerator',
                'status' => 'active',
            ],
            // Users
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('User@123'),
                'role' => 'user',
                'status' => 'active',
            ],

        ]);
    }
}
