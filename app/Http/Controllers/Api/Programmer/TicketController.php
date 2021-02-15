<?php

namespace App\Http\Controllers\Api\Programmer;

use App\Http\Controllers\Api\BaseControllerForApi;
use App\Http\Requests\Programmer\TicketEditReqest;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class TicketController extends BaseControllerForApi
{
    public function index()
    {
        $user = Auth::user();
        $project = Project::select('id')->where('user_id',$user->id)->get();
        foreach ($project as $project)
        {
        $tickets = Ticket::select('*')->where('project_id', $project->id)->get();
        }
        return $this->responseSuccess($tickets);
    }

    public function edit($id)
    {
        $ticket = Ticket::select('id','deadline','description_to_client')->findOrFail($id);
        return $this->responseSuccess($ticket);
    }

    public function update(TicketEditReqest $request, $id)
    {
        $requestAll = $request->except('_token');
        if($request->hasFile('screenshot_to_client')) {
            $uploadFile = $request->file('screenshot_to_client');
            $fileName = Ticket::uploadPhoto($uploadFile);
            $requestAll['screenshot_to_client'] = $fileName;
        }
       /* $ticket = Ticket::findOrFail($id);*/
        $ticket = Ticket::select('id')->findOrFail($id);
        $ticket->description_to_client = $request->description_to_client;
        $ticket->screenshot_to_client = $fileName;
        $ticket->deadline = $request->deadline;
        $ticket->status = $request->status;
        $ticket->save();
        return $this->responseSuccess($ticket);
    }
}
