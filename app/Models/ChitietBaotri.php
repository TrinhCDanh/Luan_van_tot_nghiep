<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChitietBaotri extends Model
{
    protected $table = 'chitiet_baotri';
    protected $fillable = ['tinhtrangmay_id', 'kythuatvien_id'];

    public $timestamps = false;
}
