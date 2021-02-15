<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseControllerForApi;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends BaseControllerForApi
{
    public function index()
    {
        $tickets = Ticket::all();
        return $this->responseSuccess($tickets);
    }
}
