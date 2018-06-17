<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tinhtrangmay extends Model
{
    protected $table = 'tinhtrangmay';
    protected $fillable = ['ngayghinhan', 'mota_giangvien', 'mota_kythuatvien', 'may_id'];

    public $timestamps = false;
}
