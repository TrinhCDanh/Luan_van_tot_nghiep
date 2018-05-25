<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phongmay extends Model
{
    protected $table = 'phongmay';
    protected $fillable = ['tenphongmay', 'soluongmay'];

    public $timestamps = false;
}
