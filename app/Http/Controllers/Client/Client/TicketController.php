<?php

namespace App\Http\Controllers\Client\Client;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class TicketController extends BaseControllerForClient
{
    public function index()
    {
        $tickets = $this->get('http://helpdesk.loc/api/client/ticks');
        return view('client.tickets.index',[
            'tickets' => $tickets->data,
        ]);
    }

    public function create()
    {
        $user = session('user_id');
        $projects = $this->get('http://helpdesk.loc/api/admin/projects');
        $categories = $this->get('http://helpdesk.loc/api/admin/categories');
        return view('client.tickets.create',[
            'projects' => $projects->data,
            'categories' => $categories->data,
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $request = $request->except('_token');

        $ticket = $this->put('http://helpdesk.loc/api/client/ticks',$request,true,'screenshot');
        if($ticket == true)
        {
            return redirect()->route('ticks.index');
        }
    }

    public function show($id)
    {
        $ticket = $this->get('http://helpdesk.loc/api/client/ticks/'.$id);
        return view('client.tickets.show',[
            'ticket' => $ticket->data
        ]);

    }
}
