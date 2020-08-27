<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MateriDownload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materi_download', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file')->nullable();
            $table->string('deskripsi');
            $table->integer('id_kelas')->nullable();
            $table->integer('id_mata_pelajaran');
            $table->tinyInteger('aktif')->nullable();
            $table->integer('owner');
            $table->integer('download')->nullable();
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
        Schema::dropIfExists('materi_download');
    }
}
