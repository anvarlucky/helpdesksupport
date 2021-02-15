<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseControllerForApi;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;

class HomeController extends BaseControllerForApi
{
    public function index()
    {
        $alltickets = Ticket::all()->count();
        $allOpenTicket = Ticket::select('*')->where('status',1)->count();
        $allClosedTicket = Ticket::select('*')->where('status',2)->count();
        $programmers = User::select('*')->where('role_id',2)->count();
        return response()->json([
            'allTicket' => $alltickets,
            'openTicket' => $allOpenTicket,
            'closeTicket' => $allClosedTicket,
            'programmers' => $programmers
        ]);
    }
}
