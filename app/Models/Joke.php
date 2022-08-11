<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Joke extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','body','joke_format','punchline'];
}
