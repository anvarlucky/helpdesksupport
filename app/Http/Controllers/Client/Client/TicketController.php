<?php

namespace App\Http\Controllers\Client\Client;

use App\Http\Controllers\Client\BaseControllerForClient;
use App\Models\v1\Comment;
use App\Models\v1\Ticket;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class TicketController extends BaseControllerForClient
{
    public function index()
    {
        $tickets = $this->get('http://helpdesk.loc/api/client/ticks');
        return view('client.tickets.index',[
            'tickets' => $tickets,
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
            return redirect()->route('ticks.index',app()->getLocale());
        }
    }

    public function show($id)
    {
        $user = session('user_id');
        $ticket = Ticket::select('*')->where('id',$id)->get();

        foreach ($ticket as $tick)
        {
            $comment = Comment::select('*')->where('ticket_id',$tick->id)->get();
        }
        $route1 = $id;
        $ticket = $this->get('http://helpdesk.loc/api/client/ticks/'.$id);
        if ($user == $tick->client_id)
        return view('client.tickets.show',[
            'ticket' => $ticket->data,
            'user' => $user,
            'route1' => $route1,
            'comments' => $comment
        ]);
        else{
            return redirect()->back();
        }

    }
}