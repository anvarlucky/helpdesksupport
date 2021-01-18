<?php

namespace App\Http\Controllers\Client\Client;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;


class TicketController extends BaseControllerForClient
{
    public function index()
    {
        $tickets = $this->get('http://helpdesk.loc/api/client/tickets');
        return view('client.tickets.index',[
            'tickets' => $tickets->data,
            /*'users' =>$users->users*/
        ]);
    }

    public function create()
    {
        $projects = $this->get('http://helpdesk.loc/api/admin/projects');
        $categories = $this->get('http://helpdesk.loc/api/admin/categories');
        return view('client.tickets.create',[
            'projects' => $projects->data,
            'categories' => $categories->data
        ]);
    }

    public function store(Request $request)
    {
/*        $client = new Client(['base_uri' => 'http://helpdesk.loc']);
        $response = $client->request('POST','/api/client/tickets',['form_params' => $request, 'headers' =>$this->headers]);
        if($response==true)
            return $this->view('client.tickets.index', ['file' => $response->data]);
        $abc = json_decode($response->getBody());
        return $abc;*/
        $request = $request->except('_token');
        $ticket = $this->put('http://helpdesk.loc/api/client/tickets',$request,true,'screenshot');
        if($ticket == true)
        {
            return redirect()->route('tickets.index');
        }
    }
}
