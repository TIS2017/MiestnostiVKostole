<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupConnect extends Model
{
    protected $fillable = [
        'user_id', 'group_id', 'group_connection'
    ];
}
