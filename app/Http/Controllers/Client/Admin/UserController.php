<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserController extends BaseControllerForClient
{
    public function index()
    {
        $response = $this->get('http://helpdesk.loc/api/admin/users');
        return view('admin.users.index',[
            'users' => $response->data
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
/*        $client = new Client(['base_uri' => 'http://helpdesk.loc/']);
        $request = $request->except('_token');
        $response = $client->request('POST','api/admin/users',['form_params' => $request, 'headers' =>$this->headers]);
        if($response ==true)
        {
            return redirect()->route('users.index');
        }*/
        $response = $this->post('http://helpdesk.loc/api/admin/users', $request->except('_token'));
        if($response->success)
            return redirect()->route('users.index');
        return redirect()->back()->withErrors($response->errors);
    }

}
