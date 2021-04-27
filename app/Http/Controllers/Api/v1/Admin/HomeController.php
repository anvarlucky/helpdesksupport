<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use Illuminate\Http\Request;
use App\Models\v1\Ticket;
use App\Models\v1\User;

class HomeController extends BaseControllerForApi
{
    public function index()
    {
        $alltickets = Ticket::all()->count();
        $allOpenTicket = Ticket::select('*')->where('status',1)->count();
        $allAnsweredTicket = Ticket::select('*')->where('status',2)->count();
        $allClosedTicket = Ticket::select('*')->where('status',3)->count();
        $programmers = User::select('*')->where('role_id',2)->count();
        return response()->json([
            'allTicket' => $alltickets,
            'openTicket' => $allOpenTicket,
            'answerTicket' => $allAnsweredTicket,
            'closeTicket' => $allClosedTicket,
            'programmers' => $programmers
        ]);
    }
}
