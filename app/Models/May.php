<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class May extends Model
{
    protected $table = 'may';
    protected $fillable = ['sothutumay', 'tinhtrang', 'phongmay_id', 'slug'];

    public $timestamps = false;
}
