<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForumIsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_isi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_reply')->nullable();
            $table->string('file')->nullable();
            $table->string('deskripsi');
            $table->integer('id_forum');
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
        Schema::dropIfExists('forum_isi');
    }
}
