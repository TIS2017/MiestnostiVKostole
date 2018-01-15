<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupRequest extends Model
{
    protected $fillable = [
        'text', 'group_id', 'accepted'
    ];
}
