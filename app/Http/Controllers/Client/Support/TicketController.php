<?php

namespace App\Http\Controllers\Client\Support;

use App\Http\Controllers\Client\BaseControllerForClient;
use App\Models\v1\Category;
use App\Models\v1\Ticket;
use Illuminate\Http\Request;
use App\Models\v1\Project;
use App\Models\v1\Comment;
use Illuminate\Support\Facades\Auth;

class TicketController extends BaseControllerForClient
{
    public function index(){
        $projects = $this->get('http://support.mc.uz/api/support/ticks2');
        $project = $this->get('http://support.mc.uz/api/support/projects');
        $tickets = Ticket::all();
        return view('support.tickets.index',[
            'projects' => $projects,
            'tickets' => $tickets,
            'project' => $project->data
        ]);
    }

    public function tickets($id){
        $tickets = $this->get('http://support.mc.uz/api/support/tickSup/'.$id);
        $project = Project::findOrFail($id);
        return view('support.tickets.tickets',
            [
                'tickets' => $tickets->data,
                'project' => $project
            ]);
    }

    public function show($id){
        $user = session('user_id');
        $routeId = $id;
        $tickets = $this->get('http://support.mc.uz/api/support/tickSup/'.$id);
        $ticket = Ticket::findOrFail($id);
        foreach ($tickets->data as $tick)
        {
            $comment = Comment::select('*')->where('ticket_id',$tick->id)->get();
        }
        return view('support.tickets.ticketShow',[
            'ticket' => $ticket,
            'comments' => $comment,
            'user' => $user,
            'routeId' => $routeId
        ]);
    }

    public function create($id){
        $project = Project::findOrFail($id);
        $categories = Category::select('*','name->uz as name_uz')->where('project_id',$id)->get();
        $user = session('user_id');
        return view('support.tickets.create',[
            'project' => $project,
            'categories' => $categories,
            'user' => $user
        ]);
    }

    public function store(Request $request,$id){
        $user = session('user_id');
        $project = Project::select('id')->where('id',$id)->first();
        $requestAll = $request->except('_token');
        if($request->hasFile('screenshot')==true) {
            $uploadFile = $request->file('screenshot');
            $fileName = Ticket::uploadPhoto($uploadFile);
            $requestAll['screenshot'] = $fileName;
        }
        else{
            $fileName = null;
        }
        $ticket = new Ticket;
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->screenshot = $fileName;
        $ticket->category_id = $request->category_id;
        $ticket->client_id = $user;
        $ticket->priority = $request->priority;
        if($project->users){
            $ticket->project_id = $id;
            $ticket->save();
            $ticket->users()->attach($project->users);
        }
        $ticket->save();
        if($ticket==true){
            return redirect()->route('ticks2.ticket',$id);
        }
    }

    //test for git
}
