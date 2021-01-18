<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\BaseControllerForApi;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends BaseControllerForApi
{
    public function index()
    {
        $tickets = Ticket::getAll();
        return response()->json([
            'success' => true,
            'lang' => app()->getLocale(),
            'data' => $tickets,
            'status' => 200
        ])->withHeaders($this->headers);
    }

    public function store(Request $request)
    {
        $requestAll = $request->except('_token');
        if($request->hasFile('screenshot')) {
            $uploadFile = $request->file('screenshot');
            $fileName = Ticket::uploadPhoto($uploadFile);
            $requestAll['screenshot'] = $fileName;
        }
        $ticket = new Ticket;
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->screenshot = $fileName;
        $ticket->project_id = $request->project_id;
        $ticket->category_id = $request->category_id;
        $ticket->save();
        $ticket->users()->attach($request->users);
        if($ticket==true){
            return response()->json([
                'success' => true,
                'lang' => app()->getLocale(),
                'data' => $ticket,
                'status' => 201
            ])->withHeaders($this->headers);
        }
    }

    public function show($id)
    {
        $ticket = Ticket::select('*')->findOrFail($id);
        return response()->json([
            'success' => true,
            'lang' => app()->getLocale(),
            'data' => $ticket,
            'users'=>$ticket->users,
            'status' => 200
        ])->withHeaders($this->headers);
    }
}
