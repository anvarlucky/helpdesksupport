<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;

class TicketController extends BaseControllerForClient
{
    public function index()
    {
        $tickets = $this->get('http://helpdesk.loc/api/admin/ticket');
        return view('admin.tickets.index',[
           'tickets' => $tickets->data
        ]);
    }
}
