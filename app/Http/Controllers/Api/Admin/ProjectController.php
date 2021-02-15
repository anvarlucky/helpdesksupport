<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseControllerForApi;
use App\Http\Requests\Admin\Projects\ProjectCreateRequest;
use App\Models\Project;

class ProjectController extends BaseControllerForApi
{
    public function index()
    {
        $projects = Project::getAll();
        return $this->responseSuccess($projects);

    }

    public function create()
    {
        //

    }

    public function store(ProjectCreateRequest $request)
    {
        $requestAll = [
            'name' => $request->name,
            'url' => $request->url,
            'user_id' => $request->user_id,
        ];
        $project = Project::create($requestAll);
        return $this->responseSave($project);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $email = $project->user->email;
        return $this->responseSuccess($email);
    }

    public function edit($id)
    {
        return $id;
        $editProject = Project::findorFail($id);
        return $this->responseSuccess($editProject);
    }

    public function update(Request $request, $id)
    {
        $editProject = Project::find($id);
                $editProject->name = $request->input('name');
                $editProject->url = $request->input('url');
                $editProject->save();
        return response()->json([
            'success' => true,
            'lang' => app()->getLocale(),
            'data' => $editProject,
            'status' => 200
        ])->withHeaders($this->headers);

    }

    public function destroy($id)
    {
        $deleteProject = Project::destroy($id);
        return $this->responseSuccess($deleteProject);
    }
}
