<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoribayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategoribayaran', function (Blueprint $table) {
			$table->increments('id');
			$table->string('nama',255)->nullable();
			$table->string('nominal',255)->nullable();
			$table->enum('tingkat',['1','2','3'])->nullable()->default('1');
			$table->enum('aktif',['Y','N'])->nullable()->default('Y');

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
        Schema::dropIfExists('kategoribayaran');
    }
}
