<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Announcement extends Model
{
    protected $guarded = [];
    public const STORAGE_URL = 'public/announcement/photo';

    public static function uploadPhoto($uploadFile){
        $filename = time().$uploadFile->getClientOriginalName();
        Storage::disk('local')->putFileAs(
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
}
