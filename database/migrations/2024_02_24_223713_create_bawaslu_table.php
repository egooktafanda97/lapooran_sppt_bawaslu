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
        Schema::create('bawaslu', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("user_id")->nullable();
            $table->string("nama");
            $table->string("singkatan_penomoran_surat");
            $table->string('provinsi_id', 2)->index();
            $table->string('kabupaten_id', 4)->index();
            $table->string('kecamatan_id', 7)->index();
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
        Schema::dropIfExists('bawaslu');
    }
};
