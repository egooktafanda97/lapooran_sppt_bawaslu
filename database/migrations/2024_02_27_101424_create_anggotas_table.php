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
        Schema::create('anggota', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("user_id")->nullable();
            $table->integer('bawaslu_id');
            $table->integer('user_id');
            $table->integer('jabatan_id');
            $table->string('no_sk');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('status_anggota')->default("aktif");
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
        Schema::dropIfExists('anggota');
    }
};
