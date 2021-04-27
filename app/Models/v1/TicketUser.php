<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;

class TicketUser extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany('App\Models\v1\User','ticket_users','ticket_id','user_id')->withTimestamps();
    }

    public function tickets()
    {
        return $this->belongsToMany('App\Models\v1\Ticket','ticket_users','user_id','ticket_id')->withTimestamps();
    }
}
