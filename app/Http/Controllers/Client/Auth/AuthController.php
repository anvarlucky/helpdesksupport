<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($request-> isMethod('post')) {

            $response = $this->post('login123', $request->except('_token'));
            dd($response);
            return view('login');
        }
    }
}
