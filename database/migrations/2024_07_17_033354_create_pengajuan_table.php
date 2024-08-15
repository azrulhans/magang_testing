<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jurusan');
            $table->string('nim');
            $table->string('nama_sekolah');
            $table->string('email');
            $table->string('alamat');
            $table->string('no_hp');
	        $table->date('tgl_awal');
	        $table->date('tgl_akhir');
            $table->string('foto');
            $table->string('surat');
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
        Schema::dropIfExists('pengajuan');
    }
}