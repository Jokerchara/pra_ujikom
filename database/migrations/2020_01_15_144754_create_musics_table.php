<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('judul');
            $table->String('slug');
            $table->unsignedBigInteger('id_grup');
            $table->foreign('id_grup')->references('id')->on('grups')->ondelete('cascade');
            $table->unsignedBigInteger('id_album');
            $table->foreign('id_album')->references('id')->on('albums')->ondelete('cascade');
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
        Schema::dropIfExists('musics');
    }
}
