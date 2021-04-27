<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends BaseControllerForClient
{
    public function login(Request $request)
    {
        if($request->isMethod('post')) {
            $response = $this->post('http://helpdesk.loc/api/login',$request->except('_token'));
            if($response->success && $response->data->token)
            {
                session(['access-token' => $response->data->token, 'user' => $response->data->user, 'role' => $response->data->role,'user_id' => $response->data->user_id]);
                if(session('role')==1) {
                    return redirect()->route('home',app()->getLocale());
                }
                if(session('role')==2) {
                    return redirect()->route('tickets.index',app()->getLocale());
                }
                if(session('role')==3) {
                    return redirect()->route('ticks2.index',app()->getLocale());
                }
                if(session('role')==4) {
                    return redirect()->route('ticks.index',app()->getLocale());
                }
                else{
                    return redirect('/');
                }
            }
            return redirect('login')->withErrors($response->errors);
        }
        return view('login');
    }
    public function logout(Request $request)
    {
        Session::remove('access-token');
        return redirect('/');
    }
}
