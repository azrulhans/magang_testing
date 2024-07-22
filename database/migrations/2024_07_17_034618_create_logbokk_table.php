<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbokkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbokk', function (Blueprint $table) {
            $table->id();
            $table->string('hari');
            $table->string('tanggal');
            $table->text('deskripsi');
            $table->string('foto');
            $table->string('laporan_akhir');
	        $table->date('tanggal_awal');
	        $table->date('tanggal_akhir');
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
        Schema::dropIfExists('logbokk');
    }
}