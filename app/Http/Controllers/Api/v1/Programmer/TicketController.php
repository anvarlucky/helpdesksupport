<?php

namespace App\Http\Controllers\Api\v1\Programmer;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use App\Http\Requests\Programmer\TicketEditReqest;
use App\Models\v1\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends BaseControllerForApi
{

    public function index()
    {

        $user = Auth::user();
        return $this->responseSuccess($user->tickets);
/*        foreach ($projects as $project)
        {
            return $project->tickets;
            $arrays = $project->toArray();
            return $arrays;
            $tickets = Ticket::select('*')->whereIn('project_id', [3,4])->get();
            return $this->responseSuccess($tickets);
        }*/
    }

    public function edit($id)
    {
        $ticket = Ticket::select('*')->findOrFail($id);
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
        else{
            $fileName = null;
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

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return $this->responseSuccess($ticket);
        $user = Auth::user();
        if ($user->id == $ticket->client_id) {
            return $this->responseSuccess($ticket);
        }
    }
}
