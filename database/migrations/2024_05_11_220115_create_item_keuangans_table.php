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
        Schema::create('item_keuangan', function (Blueprint $table) {
            $table->id();
            $table->integer("keuangan_id")->nullable();
            $table->integer("user_id");
            $table->integer('bawaslu_id');
            $table->string('nomor');
            $table->string('no_surat_pencairan')->nullable();
            $table->string('dikeluarkan_oleh');
            $table->string('nama_penerima');
            $table->string('uraian');
            $table->string('tanggal_surat');
            $table->string('tanggal_terima');
            $table->string('jumlah');
            $table->string('ppn')->nullable();
            $table->string('pph')->nullable();
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
        Schema::dropIfExists('item_keuangans');
    }
};
