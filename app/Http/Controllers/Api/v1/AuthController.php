<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Models\v1\User;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AuthController extends  BaseControllerForApi
{
    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return $this->responseValidation([
                'errors' => 'login or password is Invalid'
            ]);
        }
        $user = Auth::user();
        $role = $user->role_id;
        $user_id = $user->id;
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
            'role' => $role,
            'user_id' => $user_id,
        ], 200);

    }
    public function registration(UserRequest $request){
        $user = User::create($request->all());
        return $this->responseSave($user);
    }

    public function logout(){
        $accessToken = auth('api')->user()->token()->revoke();
        return $this->responseSuccess($accessToken);
    }
}
