<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\BlogPost;

class UpdateExistingBlogPostsSetAuthor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        BlogPost::whereNull('author')->update(['author' => 'Unknown']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        BlogPost::where('author', 'Unknown')->update(['author' => null]);
    }
}
