<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\User::create([
            'name' => "Gayan Sandaruwan",
            'email' => "gayan@ciperlabs.com",
            'type' => "admin",
            'password' => Hash::make('qwer1234'),
        ]);
    }
}
