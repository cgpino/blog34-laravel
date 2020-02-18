<?php

use Illuminate\Database\Seeder;
use App\Topic;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::create([
        	'name' => 'cine',
        ]);

        Topic::create([
        	'name' => 'videojuegos',
        ]);

        Topic::create([
        	'name' => 'deportes',
        ]);

        Topic::create([
        	'name' => 'teatro',
        ]);

        print("> Se han insertado los datos de prueba de temas.\n");
    }
}
