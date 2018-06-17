<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tuanhoc extends Model
{
    protected $table = 'tuanhoc';
    protected $fillable = ['tentuan', 'ngaydautuan', 'ngaycuoituan', 'hocky_id'];

    public $timestamps = false;
}
