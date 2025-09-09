<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikel', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('kategori_id');
			$table->foreign('kategori_id')->references('id')->on('kategori');
			$table->string('seo',255)->nullable();
			$table->string('judul',255)->nullable();
			$table->string('gambar',255)->nullable();
			$table->longText('keterangan')->nullable();
			$table->enum('status',['darft','publish'])->nullable()->default('darft');

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
        Schema::dropIfExists('artikel');
    }
}
