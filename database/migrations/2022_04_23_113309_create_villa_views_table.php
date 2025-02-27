<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillaViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villa_views', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("id_villa");
            $table->string("titleslug");
            $table->string("url");
            $table->string("session_id");
            $table->unsignedInteger('user_id')->nullable();
            $table->string("ip");
            $table->string("agent");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('villa_views');
    }
}
