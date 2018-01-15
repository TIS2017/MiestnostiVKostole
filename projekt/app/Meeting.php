<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'date_id', 'room_id','group_id','repeat'
    ];
}
