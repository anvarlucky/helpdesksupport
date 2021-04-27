<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use Illuminate\Http\Request;
use App\Models\v1\Comment;
use App\Models\v1\TicketUser;
use Illuminate\Support\Facades\Auth;

class CommentController extends BaseControllerForApi
{
    public function index()
    {
        $user = Auth::user();
        return $user->id->ticket;
    }

    public function list($id=1)
    {
        $comment = Comment::select('*')->findOrFail($id);
        return $comment;
    }
}
