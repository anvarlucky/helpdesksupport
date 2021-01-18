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
       $users = $this->get('http://helpdesk.loc/api/admin/users');
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
}
