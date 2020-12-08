<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCtgiohangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctgiohang', function (Blueprint $table) {
            $table->integer('id_dh')->unsigned();
            $table->integer('id_sach')->unsigned();
            $table->foreign('id_sach')->references('id_sach')->on('dausach')->onDelete('cascade');
            $table->foreign('id_dh')->references('id_dh')->on('donhang')->onDelete('cascade');
            $table->integer('so_luong');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ctgiohang');
    }
}
