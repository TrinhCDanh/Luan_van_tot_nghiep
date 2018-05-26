<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    protected $table = 'lop';
    protected $fillable = ['id', 'tenlop', 'siso'];

    public $timestamps = false;
}
