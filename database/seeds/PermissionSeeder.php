<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Posts
        Permission::create(['name' => 'create_post']);
        Permission::create(['name' => 'edit_post']);
        Permission::create(['name' => 'delete_post']);

        // Comentarios
        Permission::create(['name' => 'delete_comment']);

        // Topics
        Permission::create(['name' => 'create_topic']);
        Permission::create(['name' => 'edit_topic']);
        Permission::create(['name' => 'delete_topic']);

        print("> Se han insertado los datos de prueba de permisos.\n");
    }
}
