<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monhoc extends Model
{
    protected $table = 'monhoc';
    protected $fillable = ['id', 'tenmonhoc', 'ngaybatdau', 'ngayketthuc'];

    public $timestamps = false;
}
