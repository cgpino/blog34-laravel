<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Administrator']);

        // Posts
        $role->givePermissionTo('create_post');
        $role->givePermissionTo('edit_post');
        $role->givePermissionTo('delete_post');

        // Comentarios
        $role->givePermissionTo('delete_comment');

        // Topics
        $role->givePermissionTo('create_topic');
        $role->givePermissionTo('edit_topic');
        $role->givePermissionTo('delete_topic');

        print("> Se han insertado los datos de prueba de roles.\n");
    }
}
