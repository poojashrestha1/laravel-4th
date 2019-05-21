<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{ protected $table="gallerys";
    protected $fillable = [
        'gtype',
        'name',
        'description',
        'image',
        'status'
    ];
}

