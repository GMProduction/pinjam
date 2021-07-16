<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePeminjamans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('tb_pinjam', function (Blueprint $table) {
            $table->bigInteger('id_staf')->unsigned()->nullable(true);
            $table->foreign('id_staf')->references('id')->on('tb_staf');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
