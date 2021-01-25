<?php

namespace App\Http\Controllers\Api\Programmer;

use App\Http\Controllers\Api\BaseControllerForApi;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends BaseControllerForApi
{
    public function index()
    {
        $user = Auth::user();
        $tickets = Ticket::select('*')->where('project_id', 2)->get();
        return $this->responseSuccess($tickets);
    }

    public function edit($id)
    {
        $ticket = Ticket::select('id')->findOrFail($id);
        return $this->responseSuccess($ticket);
    }

    public function update(Request $request, $id)
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
        $ticket->save();
        return $this->responseSuccess($ticket);
    }
}
