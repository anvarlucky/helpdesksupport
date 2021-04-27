<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;


class ProjectController extends BaseControllerForClient
{
   public function index()
   {
       $projects = $this->get('http://helpdesk.loc/api/admin/projects');
       return view('admin.projects.index',[
           'projects' => $projects->data
       ]);
   }

   public function create()
   {
       $users = $this->get('http://helpdesk.loc/api/admin/programmers');
       return view('admin.projects.create',[
           'users' => $users->data
       ]);
   }

   public function store(Request $request)
   {
       $request = $request->except('_token');
       $project = $this->post('http://helpdesk.loc/api/admin/projects',$request);
       if($project->success)
       {
           return redirect()->route('projects.index');
       }
       return redirect()->back()->withErrors($project->errors);

   }

   public function show($id){
        $project = $this->get('http://helpdesk.loc/api/admin/projects/'.$id);
        return view('admin.projects.show',[
            'project' => $project->data
        ]);
   }

   public function edit($id){
       $project = $this->get('http://helpdesk.loc/api/admin/projects/'.$id);
       $users = $this->get('http://helpdesk.loc/api/admin/programmers');
       return view('admin.projects.edit',[
           'project' => $project->data,
           'users' => $users->data
       ]);
   }

   public function update(Request $request,$id){
        $request = $request->except('token');
        $project = $this->put('http://helpdesk.loc/api/admin/projects/'.$id,$request,false);
        if ($project==true){
            return redirect()->route('projects.index');
        }
   }

    public function destroy($id)
    {
        $project = $this->delete('http://helpdesk.loc/api/admin/projects/'.$id);
        if($project->success)
            return redirect()->route('projects.index');
        return redirect()->back()->withErrors($project->errors);
    }
}
