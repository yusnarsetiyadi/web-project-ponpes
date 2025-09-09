<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunbankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akunbank', function (Blueprint $table) {
			$table->increments('id');
			$table->string('norek',255)->nullable();
			$table->string('atas_nama',255)->nullable();
			$table->string('nama_bank',255)->nullable();
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
        Schema::dropIfExists('akunbank');
    }
}
