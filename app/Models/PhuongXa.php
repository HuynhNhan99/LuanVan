<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhuongXa extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tenxa','type','maqh'
    ];
    protected $primarykey = 'maxa';
    protected $table = 'tbl_xaphuongthitran';
}
