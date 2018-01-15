<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelMeetingRequest extends Model
{
    protected $fillable = [
        'text', 'meeting_id', 'accepted'
    ];
}
