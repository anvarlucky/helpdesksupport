<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TicketController extends BaseControllerForClient
{
    public function index()
    {
        $client = new Client(['base_uri'=>'http://helpdesk.loc']);
        $response = $client->request('GET','api/client/tickets');
        $tickets = json_decode($response->getBody());
        dd($tickets);
        return view('client.tickets.index',[
            'tickets' => $tickets
        ]);
    }
}
