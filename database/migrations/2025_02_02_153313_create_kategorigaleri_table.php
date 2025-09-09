<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategorigaleriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategorigaleri', function (Blueprint $table) {
			$table->increments('id');
			$table->string('seo',255)->nullable();
			$table->string('judul',255)->nullable();
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
        Schema::dropIfExists('kategorigaleri');
    }
}
