<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = ['name', 'group', 'answers', 'correct_answers'];

    protected $casts = [
        'answers' => 'array',
    ];
}