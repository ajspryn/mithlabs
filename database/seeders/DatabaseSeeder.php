<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'Adji Supriyono',
            'username' => 'ajspryn',
            'email' => 'adjisupriyono@gmail.com',
            'password' => Hash::make('12345678'),
            'avatar' => 'avatar/avatar.png',
            'role_id' => '6',
        ]);

        DB::table('roles')->insert([
            'id' => 1,
            'role' => 'admin',
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'role' => 'owner',
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'role' => 'accounting',
        ]);
        DB::table('roles')->insert([
            'id' => 4,
            'role' => 'production',
        ]);
        DB::table('roles')->insert([
            'id' => 5,
            'role' => 'qc',
        ]);
        DB::table('roles')->insert([
            'id' => 6,
            'role' => 'warehouse',
        ]);
    }
}
