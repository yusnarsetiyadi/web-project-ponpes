<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendidikanakhirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendidikanakhir', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('santri_id');
			$table->foreign('santri_id')->references('id')->on('santri');
			$table->string('nama_sekolah',255)->nullable();
			$table->string('tahun_lulus',255)->nullable();
			$table->string('nilai_rata_rata',255)->nullable();

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
        Schema::dropIfExists('pendidikanakhir');
    }
}
