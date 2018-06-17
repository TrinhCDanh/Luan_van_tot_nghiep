<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dangkybu extends Model
{
    protected $table = 'dangky_daybu';
    protected $fillable = ['dangky_nghi_id', 'tentuan', 'thu_id', 'ca_id', 'phongmay_id'];

    public $timestamps = false;
}
