<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.ge',
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@user.ge',
            'password' => bcrypt('user'),
            'role' => 'user'
        ]);
    }
}
