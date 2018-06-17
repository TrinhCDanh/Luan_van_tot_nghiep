<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $table = 'image';
    protected $fillable = ['image'];

    public $timestamps = false;
}
