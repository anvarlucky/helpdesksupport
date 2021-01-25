<?php

namespace App\Http\Controllers\Client\Client;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;


class TicketController extends BaseControllerForClient
{
    public function index()
    {
        $tickets = $this->get('http://helpdesk.loc/api/client/tickets');
        return view('client.tickets.index',[
            'tickets' => $tickets->data,
        ]);
    }

    public function create()
    {
        $projects = $this->get('http://helpdesk.loc/api/admin/projects');
        $categories = $this->get('http://helpdesk.loc/api/admin/categories');
        return view('client.tickets.create',[
            'projects' => $projects->data,
            'categories' => $categories->data
        ]);
    }

    public function store(Request $request)
    {
        $request = $request->except('_token');
        $ticket = $this->put('http://helpdesk.loc/api/client/tickets',$request,true,'screenshot');
        if($ticket == true)
        {
            return redirect()->route('tickets.index');
        }
    }
}
