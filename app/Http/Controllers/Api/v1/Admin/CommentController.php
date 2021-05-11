<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use Illuminate\Http\Request;
use App\Models\v1\Comment;
use App\Models\v1\Ticket;
use Auth;

class CommentController extends BaseControllerForApi
{
    public function create($id,Request $request)
    {
        if ($request->isMethod('post')) {
            $ticket = Ticket::findOrFail($id);
            $user = Auth::user();
            if ($ticket->status != 3) {
                $request = [
                    'ticket_id' => $id,
                    'user_id' => $user->id,
                    'comment' => $request->comment
                ];
                $comment = Comment::create($request);
                return $this->responseSuccess($comment);
            }
            return redirect()->back();
        }
        $comment = Comment::commentUsers($id);
        return $this->responseSuccess($comment);
    }
}
