<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;
use App\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all()->pluck('id');
        $users = User::all()->pluck('id');

        Comment::create([
            'body' => '¡Pole!',
            'user_id' => $users[0],
            'post_id' => $posts[0]
        ]);

        Comment::create([
            'body' => '¡SubPole!',
            'user_id' => $users[1],
            'post_id' => $posts[0]
        ]);

        Comment::create([
            'body' => 'No lo expliques, no vaya a ser que nos enteremos :roto2:',
            'user_id' => $users[2],
            'post_id' => $posts[1]
        ]);

        print("> Se han insertado los datos de prueba de comentarios.\n");
    }
}
