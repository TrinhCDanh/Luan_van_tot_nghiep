<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hocky extends Model
{
    protected $table = 'hocky';
    protected $fillable = ['tenhocky', 'namhoc', 'ngaybatdau', 'ngayketthuc'];

    public $timestamps = false;
}
