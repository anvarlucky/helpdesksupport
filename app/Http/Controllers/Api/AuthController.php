<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseControllerForApi;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Models\User;
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
