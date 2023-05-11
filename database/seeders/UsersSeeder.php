<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->truncate();
        $main_menus = array(
            array('id' => '1','first_name' => 'User1', 'last_name' => 'last_User1','email' => 'last_User1@gmail.com', 'password' => Hash::make('123456')),
            array('id' => '2','first_name' => 'User2', 'last_name' => 'last_User2','email' => 'last_User2@gmail.com', 'password' => Hash::make('123456')),
            array('id' => '3','first_name' => 'User3', 'last_name' => 'last_User3','email' => 'last_User3@gmail.com', 'password' => Hash::make('123456')),
            array('id' => '4','first_name' => 'User4', 'last_name' => 'last_User4','email' => 'last_User4@gmail.com', 'password' => Hash::make('123456')),
            array('id' => '5','first_name' => 'User5', 'last_name' => 'last_User5','email' => 'last_User5@gmail.com', 'password' => Hash::make('123456')),
        );
        \Illuminate\Support\Facades\DB::table('users')->insert($main_menus);
    }
}
