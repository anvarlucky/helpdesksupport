<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserController extends BaseControllerForClient
{
    public function index()
    {
        $client = new Client(['base_uri' => 'http://helpdesk.loc']);
        $response = $client->request('GET','api/admin/users');
        $users = json_decode($response->getBody());
        return view('admin.users.index',[
            'users' => $users->data
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $client = new Client(['base_uri' => 'http://helpdesk.loc/']);
        $request = $request->except('_token');
        $response = $client->request('POST','api/admin/users',['form_params' => $request, 'headers' =>$this->headers]);
        if($response ==true)
        {
            return redirect()->route('users.index');
        }
    }

}
