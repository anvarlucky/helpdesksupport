<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'url','user_id'];

    public static function getAll()
    {
        return Project::select('*')->get();
    }

    public static function getWithProgrammers(){
        $projectUser = Project::select('projects.*', 'usr.firstname')
            ->join('project_user','projects.id')
            ->leftJoin('users as usr','projects.id as id')
            ->get();
        return $projectUser;
    }

    public static function getOne($id)
    {
        return Project::select('*')->where('id',$id)->get();
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\v1\User','project_user','project_id','user_id')->withTimestamps();
    }

    public function user()
    {
        return $this->hasOne('App\Models\v1\User','user_id');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\v1\Category');
    }

    public function tickets()
    {
        return $this->hasMany('App\Models\v1\Ticket');
    }

    public function announcements()
    {
        return $this->belongsToMany('App\Models\v1\Announcement','announcement_project','project_id','announcement_id');
    }
}
