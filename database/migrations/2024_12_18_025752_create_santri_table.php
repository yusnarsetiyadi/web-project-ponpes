<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSantriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
			$table->increments('id');
			$table->string('nama_lengkap',255)->nullable();
			$table->string('tempat_lahir',255)->nullable();
			$table->date('tanggal_lahir');
			$table->enum('jenis_kelamin',['-','laki-laki','perempuan'])->nullable()->default('-');
			$table->string('email',255)->nullable();
			$table->string('password',255)->nullable();

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
        Schema::dropIfExists('santri');
    }
}
