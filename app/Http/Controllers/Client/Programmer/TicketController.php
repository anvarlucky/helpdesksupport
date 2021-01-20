<?php

namespace App\Http\Controllers\Client\Programmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Client\BaseControllerForClient;

class TicketController extends BaseControllerForClient
{
    public function index()
    {
       $response = $this->get('http://helpdesk.loc/api/programmer/tickets');
       return view('programmer.tickets.index',[
           'tickets' => $response->data
       ]);

    }

    public function edit($id)
    {
        $response = $this->get('http://helpdesk.loc/api/programmer/tickets/'.$id.'/edit');
        dd($response);
        return view('programmer.tickets.edit',[
            'ticket' => $response->data
        ]);
    }

    public function update(Request $request, $id)
    {
        $request = $request->except('_token');
        $ticket = $this->put('http://helpdesk.loc/api/programmer/tickets/'.$id,$request,true,'screenshot_to_client');
        if($ticket == true)
        {
            return redirect()->route('tickets.index');
        }
    }
}
