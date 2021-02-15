<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseControllerForApi;
use App\Http\Requests\Admin\Users\UserCreateRequest;
//use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectUser;
use GuzzleHttp;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseControllerForApi
{
    public function index()
    {
        return $this->responseSuccess(User::getAll());
    }

    public function create()
    {
        //
    }

    public function store(UserCreateRequest $request)
    {
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->login = $request->login;
        $user->phone = $request->phone;
        if($user->save()==true)
        {
            return $this->responseSave($user);
        }
        return $this->responseValidation($user);
        /*return $this->responseValidation($user);*/
        /*if ($user->save()==true)
        {



        return response()->json([
            'success' => true,
            'lang' => app()->getLocale(),
            'data' => $user,
            'status' => 201
        ])->withHeaders($this->headers);
        }*/
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
