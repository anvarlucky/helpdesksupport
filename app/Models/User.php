<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public static function getAll()
    {
        return self::select('id','firstname','email','phone','role_id','deleted_at')->get();
    }

    public function tickets()
    {
        return $this->belongsToMany('App\Models\Ticket','ticket_users','user_id','ticket_id');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project','project_user','project_id','user_id');
    }
}
