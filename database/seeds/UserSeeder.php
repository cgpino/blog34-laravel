<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
        	'name' => 'r2d2',
        	'email' => 'r2d2@starwars.com',
        	'password' => Hash::make('starwars')
        ]);

        // r2d2 es el unico administrador
        $admin->assignRole('Administrator');

        User::create([
        	'name' => 'c3po',
        	'email' => 'c3po@starwars.com',
        	'password' => Hash::make('starwars')
        ]);

        User::create([
        	'name' => 'luke',
        	'email' => 'luke@starwars.com',
        	'password' => Hash::make('starwars')
        ]);

        User::create([
        	'name' => 'vader',
        	'email' => 'vader@starwars.com',
        	'password' => Hash::make('starwars')
        ]);

        print("> Se han insertado los datos de prueba de usuarios.\n");
    }
}
