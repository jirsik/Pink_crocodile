<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        DB::table('user_role')->truncate();

        DB::table('roles')->insert([
            'role' => 'admin',
        ]);
        DB::table('roles')->insert([
            'role' => 'user',
        ]);
        DB::table('user_role')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
