<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NXB extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'ten_nxb'
    ];
    protected $primarykey = 'id_nxb';
    protected $table = 'nxb';

}
