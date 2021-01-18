<?php

namespace App\Http\Controllers\Api\Programmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tickets = Ticket::select('*')->where('project_id', $user->project_id)->get();
        return $tickets;
    }

    public function create($id)
    {

    }
}
