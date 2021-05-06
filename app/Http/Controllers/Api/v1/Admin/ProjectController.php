<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use App\Http\Requests\Admin\Projects\ProjectCreateRequest;
use App\Models\v1\Project;
use Illuminate\Http\Request;
use Laravel\Passport\Bridge\User;


class ProjectController extends BaseControllerForApi
{
    public function index()
    {
        $projects = Project::getWithProgrammers();
        return $this->responseSuccess($projects);

    }

    public function create()
    {
        //

    }

    public function store(ProjectCreateRequest $request)
    {
        $project = new Project();
        $project->name = $request->name;
        $project->url = $request->url;
        $project->save();
        $project->users()->attach($request->users);
        return $this->responseSave($project);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return $this->responseSuccess($project);
    }

    public function edit($id)
    {
        $editProject = Project::findorFail($id);
        return $this->responseSuccess($editProject);
    }

    public function update(Request $request, $id)
    {
        $editProject = Project::find($id);
                $editProject->name = $request->name;
                $editProject->url = $request->url;
                $editProject->save();
                if ($editProject==true && $request->users !=null){
                foreach ($editProject->users as $user) {
                        $editProject->users()->detach($user->id);
                }
                    $editProject->users()->attach($request->users);
                }
        return $this->responseSuccess($editProject);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $users = $project->users()->detach();
        if ($users==true or $users ==null)
        $deleteProject = Project::destroy($id);
        return $this->responseSuccess($deleteProject);
    }

    public function programmers(){
        $programmers = User::where('role_id',2)->get();
        return $this->responseSuccess($programmers);
    }
}
