<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'url','user_id'];

    public static function getAll()
    {
        return Project::select('*')->get();
    }

    public static function getOne($id)
    {
        return Project::select('*')->where('id',$id)->get();
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User','project_user','user_id','project_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User','user_id');
    }
}
