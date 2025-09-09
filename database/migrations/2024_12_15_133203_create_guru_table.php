<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('nip')->nullable()->default(0);
			$table->string('nama_guru',255)->nullable();
			$table->unsignedInteger('provinsi_id');
			$table->foreign('provinsi_id')->references('id')->on('provinsis');
			$table->unsignedInteger('kabkot_id');
			$table->foreign('kabkot_id')->references('id')->on('kabkots');
			$table->unsignedInteger('kec_id');
			$table->foreign('kec_id')->references('id')->on('kecs');
			$table->unsignedInteger('desa_id');
			$table->foreign('desa_id')->references('id')->on('desas');
			$table->unsignedInteger('kontak');
			$table->foreign('kontak')->references('id')->on('kontaks');
			$table->string('alamat',255)->nullable();
			$table->string('foto',255)->nullable();
			$table->text('keterangan')->nullable();

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
        Schema::dropIfExists('guru');
    }
}
