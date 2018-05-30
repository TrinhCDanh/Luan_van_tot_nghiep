<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lichtruc extends Model
{
    protected $table = 'chitiet_truc';
    protected $fillable = ['hocky_id', 'thu_id', 'ca_id', 'kythuatvien_id', 'ghichu'];

    public $timestamps = false;
}
