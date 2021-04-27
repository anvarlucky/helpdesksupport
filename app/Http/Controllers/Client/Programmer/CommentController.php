<?php

namespace App\Http\Controllers\Client\Programmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\v1\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->ticket_id = $request->ticket_id;
        $comment->comment = $request->comment;
        if ($comment->comment==null)
        {
            return redirect()->back();
        }
        $comment->save();
        return redirect()->back();
    }
}

