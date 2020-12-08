<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DauSach extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'ten_sach','gia_sach','mo_ta','so_trang','chieu_dai','chieu_rong','trang_thai','hinh_anh','ngon_ngu','id_ncc','id_nxb','id_tg','id_km','id_tl','ngay_nhap'
    ];
    protected $primarykey = 'id_sach';
    protected $table = 'dausach';
}
