<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Topic;
use App\Comment;

class Post extends Model
{
    //protected $table = 'my_professions';

    //public $timestamps = false;

    protected $fillable = ['title', 'body', 'user_id', 'topic_id', 'image_url'];

    // Un post pertenece a un usuario
    public function user() { // user_id
        return $this->belongsTo(User::class);
        // return $this->hasOne(User::class);
    }

    // Un post pertenece a un topic
    public function topic() { // topic_id
        return $this->belongsTo(Topic::class);
    }

    // Un post puede tener ninguno o muchos comentarios
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function getImageAttribute() {
        return $this->profile_image;
    }
}