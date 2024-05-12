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
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->nullable();
            $table->integer('bawaslu_id');
            $table->string('no_surat');
            $table->string('no_dipa');
            $table->date('tanggal');
            $table->string('klarifikasi_belnja');
            $table->string('pengeluaran');
            $table->string('sts');
            $table->string('lampiran');
            $table->string('status_surat')->default('Dalam Proses');
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
        Schema::dropIfExists('keuangan');
    }
};
