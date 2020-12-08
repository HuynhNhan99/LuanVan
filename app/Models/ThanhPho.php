<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThanhPho extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tentp','type'
    ];
    protected $primarykey = 'matp';
    protected $table = 'tbl_tinhthanhpho';
}
