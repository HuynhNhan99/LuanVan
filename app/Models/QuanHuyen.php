<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuanHuyen extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tenqh','type','matp'
    ];
    protected $primarykey = 'maqh';
    protected $table = 'tbl_quanhuyen';
}
