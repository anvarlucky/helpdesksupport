<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    public static function getAll()
    {
        return Ticket::select('*')->get();
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User','ticket_users','ticket_id','user_id');
    }

}
