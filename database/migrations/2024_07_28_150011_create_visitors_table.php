<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->dateTime('visit_time');
            $table->string('web_page');
            $table->string('ip_address');
            $table->string('host_name');
            $table->string('browser_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
