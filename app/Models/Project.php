<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'url'];

    public static function getAll()
    {
        return Project::select('*')->get();
    }

    public static function getOne($id)
    {
        return Project::select('*')->where('id',$id)->findOrFail();
    }
}
