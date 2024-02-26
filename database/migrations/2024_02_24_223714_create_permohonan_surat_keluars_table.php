<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_surat_keluar', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('bawaslu_id');
            $table->integer('user_id');
            $table->string('kode_surat')->unique();
            $table->string('klasifikasi');
            $table->date('tanggal');
            $table->date('tanggal_dinas')->nullable();
            $table->string('perihal');
            $table->string('tujuan_surat');
            $table->string('pengirim')->nullable();
            $table->string('status_surat')->default('Dalam Proses');
            $table->string('lampiran')->nullable();
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
        Schema::dropIfExists('permohonan_surat_keluar');
    }
};
