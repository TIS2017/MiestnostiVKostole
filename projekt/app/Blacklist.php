<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    protected $fillable = [
        'date_id', 'room_id', 'group_id', 'original_meeting'
    ];
}
