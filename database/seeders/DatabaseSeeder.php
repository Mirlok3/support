<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'role'=> 'IT',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'technik',
            'email' => 'admin@admin.coms',
            'role'=> 'technik',
            'password' => bcrypt('password'),
        ]);

        DB::table('departments')->insert([
            'user_id' => '1',
            'name' => 'IT',
            'role'=> 'IT',
        ]);

        DB::table('departments')->insert([
            'user_id' => '2',
            'name' => 'technik',
            'role'=> 'technik',
        ]);
    }
}
