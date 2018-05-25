<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ca extends Model
{
    protected $table = 'ca';
    protected $fillable = ['tenca', 'tietso'];

    public $timestamps = false;
}
