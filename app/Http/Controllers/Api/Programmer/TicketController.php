<?php

namespace App\Http\Controllers\Api\Programmer;

use App\Http\Controllers\Api\BaseControllerForApi;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends BaseControllerForApi
{
    public function index()
    {
        $user = Auth::user();
        $tickets = Ticket::select('*')->where('project_id', 2)->get();
        return $this->responseSuccess($tickets);
    }

    public function create($id)
    {

    }
}
