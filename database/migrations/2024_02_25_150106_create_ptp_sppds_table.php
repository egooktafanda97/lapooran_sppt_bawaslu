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
        Schema::create('jenis_surat', function (Blueprint $table) {
            $table->increments("id");
            $table->string("jenis_surat");
            $table->timestamps();
        });

        Schema::create('ptp_sppd', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('bawaslu_id');
            $table->integer('user_id');
            $table->string("nama");
            $table->date("tanggl_keluar_st");
            $table->date("tanggal_berangkat");
            $table->date("tanggal_pulang");
            $table->string("no_spt");
            $table->string("jenis_surat_id");
            $table->string("perihal");
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
        Schema::dropIfExists('ptp_sppd');
    }
};
