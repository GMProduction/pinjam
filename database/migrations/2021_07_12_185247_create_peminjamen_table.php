<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_siswa')->unsigned()->nullable(true);
            $table->foreign('id_siswa')->references('id')->on('siswas');
            $table->bigInteger('id_barang')->unsigned()->nullable(true);
            $table->foreign('id_barang')->references('id')->on('barangs');
            $table->integer('qty');
            $table->tinyInteger('status');
            $table->bigInteger('id_guru')->unsigned()->nullable(true);
            $table->foreign('id_guru')->references('id')->on('gurus');
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
        Schema::dropIfExists('peminjamans');
    }
}