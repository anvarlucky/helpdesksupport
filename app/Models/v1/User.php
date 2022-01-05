<?php

namespace App\Models\v1;

use Illuminate\Support\Facades\Auth;
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
        return $this->belongsToMany('App\Models\v1\Ticket','ticket_users','user_id','ticket_id')->withTimestamps();
    }

    public static function ticks(){
        $user = Auth::user();
        $tickets = Ticket::select('tickets.id as id','tickets.*','pro.name as pn','cat.name as cn')
                ->where('tickets.client_id',$user->id)
            ->leftJoin('projects as pro','pro.id','=',1)->leftJoin('categories as cat','cat.id',1)->get();
        return $tickets;
    }

    public function projects()
    {
        return $this->belongsToMany('App\Models\v1\Project','project_user','user_id','project_id')->withTimestamps();
    }

    public function project()
    {
        return $this->belongsTo('App\Models\v1\Project');
    }
}
