<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrangtuawaliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orangtuawali', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('santri_id');
			$table->foreign('santri_id')->references('id')->on('santri');
			$table->string('nama',255)->nullable();
			$table->string('pekerjaan',255)->nullable();
			$table->string('penghasilan_perbulan',255)->nullable();
			$table->string('kontak',255)->nullable();

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
        Schema::dropIfExists('orangtuawali');
    }
}
