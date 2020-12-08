<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDanhgiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danhgia', function (Blueprint $table) {
            $table->increments('id_dg');
            $table->integer('diem_dg');
            $table->text('noi_dung');
            $table->string('hinh_dg');
            $table->integer('id_kh')->unsigned();
            $table->integer('id_sach')->unsigned();
            $table->foreign('id_sach')->references('id_sach')->on('dausach')->onDelete('cascade');
            $table->foreign('id_kh')->references('id_kh')->on('khachhang')->onDelete('cascade');
            $table->datetime('ngay_dg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('danhgia');
    }
}
