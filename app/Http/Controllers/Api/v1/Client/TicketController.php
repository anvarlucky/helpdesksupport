<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use App\Http\Requests\Client\TicketCreateReqest;
use App\Models\v1\Category;
use App\Models\v1\Project;
use App\Models\v1\Ticket;
use App\Models\v1\User;
use Illuminate\Support\Facades\Auth;

class TicketController extends BaseControllerForApi
{
    public function index()
    {
        $user = Auth::user();
        $tickets = Ticket::select('*')->where('client_id',$user->id)->get();
        if ($tickets == true) {
            return $this->responseSuccess($tickets);
        }
    }

    public function create(){
        $category = Category::all();
        return $this->responseSuccess($category);
    }

    public function store(TicketCreateReqest $request)
    {
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
        $ticket->user_id = $request->user_id;
        $ticket->fullname = $request->fullname;
        if($project->users) {
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
        $ticket = Ticket::client($id);
        $ticket = Ticket::findOrFail($id);
        return $ticket;
        $user = session('user_id');
        if ($user == $ticket->client_id) {
            return $this->responseSuccess($ticket);
        }
    }
}
