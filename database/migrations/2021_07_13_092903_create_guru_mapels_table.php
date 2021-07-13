<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruMapelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_guru_mapel', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_mapel')->unsigned()->nullable(true);
            $table->foreign('id_mapel')->references('id')->on('tb_mapel');
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
        Schema::dropIfExists('tb_guru_mapel');
    }
}
