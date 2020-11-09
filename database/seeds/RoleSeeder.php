<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => ('Administrator')
        ]);
        DB::table('roles')->insert([
            'name' => ('Editor')
        ]);
        DB::table('roles')->insert([
            'name' => ('Writer')
        ]);
    }
}
