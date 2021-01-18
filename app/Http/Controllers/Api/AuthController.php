<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseControllerForApi;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AuthController extends  BaseControllerForApi
{

/*    protected $headers;
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
        return response(['user'=>auth()->user(), 'access_token' => $accessToken])->withHeaders($this->headers);
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
        return response(['user' => $user], '200');
    }

    public function logout()
    {
        $token = auth('api')->user()->token()->revoke();
        if($token == true)
        return response()->json(['message' => 'You Logged out!'], 200);
    }*/

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return $this->responseValidation([
                'errors' => 'login or password is Invalid'
            ]);
        }
        $user = Auth::user();
        $role = $user->role_id;
        $token = $user->createToken(config('app.name'));
        if($token && $request->firebase_token){
            $user->firebase_token = $request->firebase_token;
            $user->save();
        }
        $token->token->expires_at = $request->remember_me ?
            Carbon::now()->addMonth() :
            Carbon::now()->addDay();
        $token->token->save();

        return $this->responseSuccess([
            'token_type' => 'Bearer',
            'user' => $user->firstname,
            'email' => $user->email,
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
            'role_id' => $role,
        ], 200);

    }

    public function registration(UserRequest $request){
        $user = User::create($request->all());
        return $this->responseSave($user);
    }



    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){
        $accessToken = auth('api')->user()->token()->revoke();
        return $this->responseSuccess($accessToken);
    }
}
