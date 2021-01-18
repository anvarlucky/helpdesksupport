<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Ticket extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public const STORAGE_URL = '/ticket/photo';

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
        return Ticket::select('*')->get();
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User','ticket_users','ticket_id','user_id');
    }

}
