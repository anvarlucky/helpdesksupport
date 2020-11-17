<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        return "dadas";
        $login = $request->email;
        $password = $request->password;
        return response()->json([$login, $password]);
    }

    public function registration(RegisterRequest $request)
    {

    }
}
