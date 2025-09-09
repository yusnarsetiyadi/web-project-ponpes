<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihan', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('santri_id');
			$table->foreign('santri_id')->references('id')->on('santri');
			$table->unsignedInteger('kategoribayaran_id');
			$table->foreign('kategoribayaran_id')->references('id')->on('kategoribayaran');
			$table->text('nominal')->nullable();
			$table->enum('tingkatpendidikan',['1','2','3'])->nullable()->default('1');
			$table->integer('bulan')->nullable()->default(0);
			$table->integer('tahun')->nullable()->default(0);
			$table->enum('status_pembyaran',['1','0'])->nullable()->default('1');

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
        Schema::dropIfExists('tagihan');
    }
}
