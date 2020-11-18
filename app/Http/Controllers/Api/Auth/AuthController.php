<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;


class AuthController extends Controller
{

    protected $headers;
    public function __construct()
    {
        $this->headers = ['Access-Control-Allow-Origin' => '*', 'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'];
    }
    public function login(LoginRequest $request)
    {
        $loginData = [
           'email' => $request->email,
            'password' =>$request->password,
        ];
        if(!auth()->attempt($loginData))
        {
            return response(['message' => 'Invalid User!']);
        }
       $accessToken = auth()->user()->createToken('authToken')->accessToken;
        /*
        $startTime = date("Y-m-d H:i:s");
        $endTime = date("Y-m-d H:i:s",strtotime('+7 days +1 hour +30 minutes +45 seconds', strtotime($startTime)));
        $expTime = \DateTime::createFromFormat("Y-m-d H:i:s", $endTime);
        $lifeTime = Passport::tokensExpireIn($expTime);
        return $lifeTime;*/
        return response(['user'=>auth()->user(), 'access_token' => $accessToken/*, 'token_lifeTime' => $lifeTime*/])->withHeaders($this->headers);
    }

    public function registration(RegisterRequest $request)
    {
        $requestAll = [
            'firstname' => $request['firstname'],
            'lastname' =>  $request['lastname'],
            'surname' => $request['surname'],
            'role_id' => $request['role_id'],
            'login' => $request['login'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            ];
        $user = User::create($requestAll);
        //$accessToken = $user->createToken('authToken')->accessToken;
        return response(['user' => $user/*, 'access_token' => $accessToken*/], '200');
    }

    public function logout()
    {
        $token = auth('api')->user()->token()->revoke();
        if($token == true)
        return response()->json(['message' => 'You Logged out!'], 200);
    }
}
