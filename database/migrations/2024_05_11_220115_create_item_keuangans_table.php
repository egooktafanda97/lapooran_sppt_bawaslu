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
            $table->integer("keuangan_id");
            $table->string('max');
            $table->string('nama_penerima');
            $table->string('uraian');
            $table->string('tanggal');
            $table->string('nomor');
            $table->string('jumlah');
            $table->string('ppn');
            $table->string('pph');
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
