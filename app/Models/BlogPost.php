<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = ['title', 'content', 'image', 'author', 'created_at'];


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}