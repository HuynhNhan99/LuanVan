<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDausachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dausach', function (Blueprint $table) {
            $table->increments('id_sach');
            $table->string('ten_sach');
            $table->integer('gia_sach');
            $table->text('mo_ta');
            $table->integer('so_trang');
            $table->integer('chieu_dai');
            $table->integer('chieu_rong');
            $table->boolean('trang_thai');
            $table->string('hinh_anh');
            $table->string('ngon_ngu');
            $table->integer('id_ncc')->unsigned();
            $table->integer('id_nxb')->unsigned();
            $table->integer('id_tg')->unsigned();
            $table->integer('id_km')->unsigned();
            $table->integer('id_tl')->unsigned();
            $table->foreign('id_ncc')->references('id_ncc')->on('nhacungcap')->onDelete('cascade');
            $table->foreign('id_nxb')->references('id_nxb')->on('nxb')->onDelete('cascade');;
            $table->foreign('id_tg')->references('id_tg')->on('tacgia')->onDelete('cascade');;
            $table->foreign('id_km')->references('id_km')->on('khuyenmai')->onDelete('cascade');;
            $table->foreign('id_tl')->references('id_tl')->on('theloai')->onDelete('cascade');
            $table->datetime('ngay_nhap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dausach');
    }
}
