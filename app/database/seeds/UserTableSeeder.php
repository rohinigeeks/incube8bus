<?php

class UserTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->delete();
 
        User::create(array(
            'username' => 'incube8bus',
            'password' => Hash::make('incube8bus')
        ));
 
        User::create(array(
            'username' => 'guest',
            'password' => Hash::make('password')
        ));
    }
 
}