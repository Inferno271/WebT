<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenameNewUsersToUsers extends Migration
{
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::rename('new_users', 'users');
    }

    public function down()
    {
        Schema::rename('users', 'new_users');
    }
}
