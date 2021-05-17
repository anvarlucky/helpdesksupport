<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use Illuminate\Http\Request;
use App\Models\v1\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Models\v1\Comment;
use App\Models\v1\Project;

class TicketController extends BaseControllerForApi
{
    public function index()
    {
        $tickets = Ticket::getAllProjectsAndCategories();
        return $this->responseSuccess($tickets);
    }

    public function store(Request $request){
        $project = Project::select('id')->where('id',$request->project_id)->first();
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
        $ticket->client_id = $request->client_id;
        $ticket->priority = $request->priority;
        if($project->users){
            $ticket->project_id = $request->project_id;
            $ticket->save();
            $ticket->users()->attach($project->users);
        }
        $ticket->save();
        if($ticket==true){
            return $this->responseSuccess($ticket);
        }
    }

    public function show($id)
    {
        $ticket = Ticket::ticketClient($id);
        return $this->responseSuccess($ticket);
    }

    public function closeTicket(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->input('status');
        $ticket->save();
        return $this->responseSuccess($ticket);
    }

    public function comment($id,Request $request)
    {
        $ticket = Ticket::findOrFail($id);
        $user = Auth::user();
        if($ticket->status != 3) {
            $request =[
            'ticket_id' => $id,
            'user_id' => $user->id,
            'comment' => $request->comment
            ];
            $comment=Comment::create($request);
            return $this->responseSuccess($comment);
        }
        return redirect()->back();


    }
}
