<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subadmin extends Model
{
    protected $fillable = [
        'group_id', 'subadmin_id'
    ];
}