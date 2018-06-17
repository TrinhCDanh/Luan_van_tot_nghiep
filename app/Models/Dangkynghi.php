<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dangkynghi extends Model
{
    protected $table = 'dangky_nghi';
    protected $fillable = ['tentuan', 'chitiet_lichday_id'];

    public $timestamps = false;
}
