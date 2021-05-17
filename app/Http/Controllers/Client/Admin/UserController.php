<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Crypt;

class UserController extends BaseControllerForClient
{
    public function index()
    {
        $response = $this->get('http://support.mc.uz/api/admin/users');
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
        $response = $this->post('http://support.mc.uz/api/admin/users', $request->except('_token'));
        if($response->success)
            return redirect()->route('users.index');
        return redirect()->back()->withErrors($response->errors);
    }

    public function show($id){
        $user = $this->get('http://support.mc.uz/api/admin/users/'.$id);
        return view('admin.users.show',[
            'user' => $user->data
        ]);
    }

    public function edit($id)
    {
        $user = $this->get('http://support.mc.uz/api/admin/users/'.$id.'edit');
        return view('admin.users.edit',[
            'user' => $user->data,
        ]);
    }

    public function update(Request $request,$id)
    {
        $request = $request->except('_token');
        $user = $this->put('http://support.mc.uz/api/admin/users/'.$id,$request,false);
        if($user == true)
        {
            return redirect()->route('users.index');
        }
    }

    public function destroy($id)
    {
        $user = $this->delete('http://support.mc.uz/api/admin/users/'.$id);
        if($user->success)
            return redirect()->route('users.index');
        return redirect()->back()->withErrors($user->errors);
    }

}
