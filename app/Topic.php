<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Topic extends Model
{
    //protected $table = 'my_professions';

    //public $timestamps = false;

    protected $fillable = ['name'];

    // Un topic puede tener ninguno o muchos posts
    public function posts() {
        return $this->hasMany(Post::class);
    }
}