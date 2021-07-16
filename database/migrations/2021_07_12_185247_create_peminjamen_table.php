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
        Schema::create('tb_pinjam', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_siswa')->unsigned()->nullable(true);
            $table->foreign('id_siswa')->references('id')->on('tb_siswa');
            $table->bigInteger('id_barang')->unsigned()->nullable(true);
            $table->foreign('id_barang')->references('id')->on('tb_barang');
            $table->integer('qty');
            $table->tinyInteger('status')->default(0);
            $table->bigInteger('id_guru')->unsigned()->nullable(true);
            $table->foreign('id_guru')->references('id')->on('tb_guru');
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
        Schema::dropIfExists('tb_pinjam');
    }
}
