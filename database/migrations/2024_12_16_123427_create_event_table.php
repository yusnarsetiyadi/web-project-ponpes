<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
			$table->increments('id');
			$table->string('seo',255)->nullable();
			$table->string('judul',255)->nullable();
			$table->string('gambar',255)->nullable();
			$table->longText('keterangan')->nullable();
			$table->date('tanggal_mulai');
			$table->date('tanggal_berakhir');
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
        Schema::dropIfExists('event');
    }
}
