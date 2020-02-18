<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
        	'permissions',
        	'roles',
        	'users',
        	'topics',
        	'posts',
        	'comments'
        ]);

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TopicSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CommentSeeder::class);
    }

    protected function truncateTables(array $tables) {

    	DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

    	foreach ($tables as $table) {
    		DB::table($table)->truncate();
    	}
    	
    	DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
