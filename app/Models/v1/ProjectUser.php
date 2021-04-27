<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $guarded = [];
    protected $table = 'project_user';
    public function user()
    {
        return $this->belongsToMany('App\Models\v1\User','users','project_id','user_id')->withTimestamps();
    }
    public function project()
    {
        return $this->belongsToMany('App\Models\v1\Project','projects','user_id','project_id')->withTimestamps();
    }

    public static function tickets($project_id)
    {
        $tickets = Ticket::where('project_id',$project_id)->get();
        return $tickets;
    }

}
