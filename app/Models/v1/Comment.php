<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\Models\v1\User');
    }

    public static function commentUsers($id){
        $comment = Comment::select('comments.*','users.firstname','users.lastname')
            ->where('ticket_id',$id)
            ->join('tickets','comments.ticket_id','=','tickets.id')
            ->join('users','comments.user_id','=','users.id')
            ->get();
        return $comment;
    }
}
