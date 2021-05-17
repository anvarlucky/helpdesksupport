<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Ticket extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public const STORAGE_URL = 'public/ticket/photo';

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

    public static function client($id)
    {
        return Ticket::select('tickets.id as id', 'tickets.*','u.firstname as fname','u.lastname as lname')
            ->where('tickets.id', $id)
            ->leftJoin('users as u', 'u.id','client_id')->firstOrFail();
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\v1\User','ticket_users','ticket_id','user_id')->withTimestamps();
    }

    public function user()
    {
        return $this->hasMany('App\Models\v1\User','client_id');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\v1\Project');
    }

    public function comments(){
        return $this->belongsToMany('App\Models\v1\Comment');
    }

    public static function getAllProjectsAndCategories(){
        $projectsCategories = Ticket::select('tickets.*', 'projects.name as project_name','categories.name->uz as category_name')
            ->leftJoin('projects','tickets.project_id','=','projects.id')
            ->leftJoin('categories','tickets.category_id', '=','categories.id')
            ->get();
        return $projectsCategories;
    }

    public static function ticketClient($id){
        $ticketClient = Ticket::select('tickets.*','users.firstname','users.lastname')
            ->where('tickets.id',$id)
            ->leftJoin('users','tickets.client_id','=','users.id')
            ->first();
        return $ticketClient;
    }
}
