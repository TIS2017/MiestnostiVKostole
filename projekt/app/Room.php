<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;


class Room extends Model
{
    protected $fillable = [
        'name','abbreviation','is_available'
    ];
}
