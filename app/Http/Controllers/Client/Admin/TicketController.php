<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;
use App\Models\v1\Ticket;
use App\Models\v1\Comment;

class TicketController extends BaseControllerForClient
{
    public function index()
    {
        $tickets = $this->get('http://support.mc.uz/api/admin/ticket');
        return view('admin.tickets.index',[
           'tickets' => $tickets->data
        ]);
    }

    public function create()
    {
        $user = session('user_id');
        $projects = $this->get('http://support.mc.uz/api/admin/projects');
        $categories = $this->get('http://support.mc.uz/api/admin/categories');
        return view('admin.tickets.create',[
            'projects' => $projects->data,
            'categories' => $categories->data,
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $request = $request->except('_token');
        $ticket = $this->put('http://support.mc.uz/api/admin/ticket',$request,true,'screenshot');
        if($ticket == true)
        {
            return redirect()->route('ticket.index',app()->getLocale());
        }
    }

    public function show($id)
    {
        $user = session('user_id');
/*        $ticket = Ticket::select('*')->where('id',$id)->get();
        foreach ($ticket as $tick)
        {
            $comment = Comment::select('*')->where('ticket_id',$tick->id)->get();
        }*/
        $comments = $this->get('http://support.mc.uz/api/admin/ticket/'.$id.'/comment');
        $routeId = $id;
        $ticket = $this->get('http://support.mc.uz/api/admin/ticket/'.$id);
        return view('admin.tickets.show',[
            'ticket' => $ticket->data,
            'user' => $user,
            'routeId' => $routeId,
            'comments' => $comments->data
        ]);

    }

    public function closeTicket(Request $request, $id)
    {
        $request = $request->except('_token');
        $ticket = $this->post('http://support.mc.uz/api/admin/close/'.$id,$request);
        if($ticket == true)
        {
            return redirect()->route('ticket.index');
        }
    }
}
