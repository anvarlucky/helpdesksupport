<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use App\Http\Requests\Admin\Users\UserCreateRequest;
use Illuminate\Http\Request;
use App\Models\v1\User;
use App\Models\v1\Project;
use App\Models\v1\ProjectUser;
use GuzzleHttp;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseControllerForApi
{
    public function index()
    {
        return $this->responseSuccess(User::getAll());
    }

    public function programmers()
    {
        $programmers = User::select('*')->where('role_id',2)->get();
        return $this->responseSuccess($programmers);
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
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->responseSuccess($user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return $this->responseSuccess($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::select('*')->findOrFail($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->surname = $request->surname;
        $user->role_id = $request->role_id;
        $user->login = $request->login;
        $user->phone = $request->phone;
        $user->email = $request->email;
        if ($user->password == null) {
            $user->password = Hash::make($request->password);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return $this->responseSuccess($user);
    }

    public function destroy($id)
    {
        return $this->responseSuccess(User::destroy($id));
    }
}
