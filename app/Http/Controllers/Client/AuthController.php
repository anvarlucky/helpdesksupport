<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
class AuthController extends BaseControllerForClient
{
    public function login(Request $request)
    {

        if($request->isMethod('post')) {
            /*$client = new GuzzleHttp\Client(['base_uri' => 'http://helpdesk.loc']);*/
            //dd(session('_token'));
            //$response = $client->request('POST','api/login');
            $request = $request->except('_token');
            $response = $this->post('http://helpdesk.loc/api/login',$request);
            if($response ==true)
            {
                session(['token' => $response->data->token, 'user' => $response->data->user, 'role' => $response->data->role_id]);
                if(session('role')==1)
                    return redirect()->route('users.index');
                elseif(session('role')==2)
                    return redirect()->route('tick.index');
                else
                    return redirect()->route('tickets.index');
            }
            /*dd($this->post('/api/login', $request->except('_token')));
            $response = $this->post('api/login', $request->except('_token'));*/
        }
        return view('login');
    }

    public function logout(Request $request)
    {
        /*$client = new GuzzleHttp\Client(['base_uri' => 'http://helpdesk.loc']);
        $response = $client->request('GET', '/api/logout');*/
        dd(Session::all());
        return redirect('/');

    }
}
