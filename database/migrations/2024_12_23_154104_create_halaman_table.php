<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHalamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halaman', function (Blueprint $table) {
			$table->increments('id');
			$table->string('seo',255)->nullable();
			$table->string('judul',255)->nullable();
			$table->longText('keterangan')->nullable();
			$table->string('gambar',255)->nullable();
			$table->enum('aktif',['N','Y'])->nullable()->default('N');

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
        Schema::dropIfExists('halaman');
    }
}
