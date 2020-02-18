<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;

class Comment extends Model
{
    protected $fillable = ['body', 'post_id', 'user_id'];

    // Un comentario pertenece a un post
    public function post() { // topic_id
        return $this->belongsTo(Post::class);
    }

    // Un comentario pertenece a un usuario
    public function user() { // topic_id
        return $this->belongsTo(User::class);
    }
}
