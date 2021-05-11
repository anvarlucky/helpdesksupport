<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;

class CommentController extends BaseControllerForClient
{
    public function create(Request $request,$id)
    {
        $request = $request->except('_token');
        $comment = $this->post('http://helpdesk.loc/api/admin/ticket/'.$id.'/comment',$request);
        if($comment == true){
            return redirect()->back();
        }
        /*$comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->ticket_id = $request->ticket_id;
        $comment->comment = $request->comment;
        if ($comment->comment==null)
        {
            return redirect()->back();
        }
        $comment->save();
        return redirect()->back();*/
    }
}

