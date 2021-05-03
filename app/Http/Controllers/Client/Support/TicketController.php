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
        $projects = Project::all()->count();
        $project = Project::all();
        $tickets = Ticket::all();
        return view('support.tickets.index',[
            'projects' => $projects,
            'tickets' => $tickets,
            'project' => $project
        ]);
    }

    public function tickets($id){
        $tickets = Ticket::where('project_id',$id)->get();
        $project = Project::findOrFail($id);
        return view('support.tickets.tickets',
            [
                'tickets' => $tickets,
                'project' => $project
            ]);
    }

    public function show($id){
        $tickets = Ticket::select('*')->where('id',$id)->get();
        $ticket = Ticket::findOrFail($id);
        foreach ($tickets as $tick)
        {
            $comment = Comment::select('*')->where('ticket_id',$tick->id)->get();
        }
        return view('support.tickets.ticketShow',[
            'ticket' => $ticket,
            'comments' => $comment
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
        $user = Auth::user();
        dd($user);
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
        $ticket->user_id = $user->id;
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
