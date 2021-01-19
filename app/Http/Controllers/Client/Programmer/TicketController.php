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
}
