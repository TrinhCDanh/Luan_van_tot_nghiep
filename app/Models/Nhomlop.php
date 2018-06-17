<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nhomlop extends Model
{
    protected $table = 'nhomlop';
    protected $fillable = ['id', 'nhomlop', 'siso', 'hocky_id'];

    public $timestamps = false;
}
