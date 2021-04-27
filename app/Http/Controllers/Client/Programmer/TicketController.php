<?php

namespace App\Http\Controllers\Client\Programmer;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;
use App\Models\v1\Ticket;
use App\Models\v1\Comment;

class TicketController extends BaseControllerForClient
{
    public function index()
    {
       $response = $this->get('http://helpdesk.loc/api/programmer/tickets');
       return view('programmer.tickets.index',[
           'tickets' => $response->data
       ]);

    }

    public function edit($id)
    {
        $response = $this->get('http://helpdesk.loc/api/programmer/tickets/'.$id.'/edit');
        if ($response->data->status==2)
            return redirect()->back();
        return view('programmer.tickets.edit',[
            'ticket' => $response->data
        ]);
    }

    public function update(Request $request, $id)
    {
        $request = $request->except('_token');
        $ticket = $this->put('http://helpdesk.loc/api/programmer/tickets/'.$id,$request,true,'screenshot_to_client');
        if($ticket == true)
        {
            return redirect()->route('tickets.index');
        }
    }

    public function show($id)
    {
        $user = session('user_id');
        $tickets = Ticket::select('*')->where('id',$id)->get();
        foreach ($tickets as $tick)
        {
            $comment = Comment::select('*')->where('ticket_id',$tick->id)->get();
        }
        $routeId = $id;
        $ticket = $this->get('http://helpdesk.loc/api/programmer/tickets/'.$id);
        return view('programmer.tickets.show',[
            'ticket' => $ticket->data,
            'user' => $user,
            'routeId' => $routeId,
            'comments' => $comment
        ]);

    }
}
