<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lichday extends Model
{
    protected $table = 'chitiet_lichday';
    protected $fillable = ['hocky_id', 'thu_id', 'ca_id', 'nhomlop_id', 'monhoc_id', 'phongmay_id', 'giangvien_id', 'tuanhoc'];

    public $timestamps = false;
}
