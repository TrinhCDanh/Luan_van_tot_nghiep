<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChitietGhinhan extends Model
{
    protected $table = 'chitiet_baotri';
    protected $fillable = ['tinhtrangmay_id', 'giangvien_id'];

    public $timestamps = false;
}
