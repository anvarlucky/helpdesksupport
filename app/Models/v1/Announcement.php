<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Announcement extends Model
{
    protected $guarded = [];
    public const STORAGE_URL = 'public/announcement/photo';

    public static function uploadPhoto($uploadFile){
        $filename = time().$uploadFile->getClientOriginalName();        Storage::disk('local')->putFileAs(
            self::STORAGE_URL,
            $uploadFile,
            $filename
        );
        return $filename;
    }

    public static function getAll()
    {
        return self::all();
    }

    public function projects()
    {
        return $this->belongsToMany('App\Models\v1\Project','announcement_project','announcement_id','project_id')->withTimestamps();
    }

    public static function announceProjects(){
        $announceProject = DB::table('announcement_project as ap')
            ->leftJoin('announcements as a','ap.announcement_id', '=', 'a.id')
            ->leftJoin('projects as p','ap.project_id','=','p.id')
            ->select('a.*','p.name as project_name')
            ->get();
        return $announceProject;
    }
}
