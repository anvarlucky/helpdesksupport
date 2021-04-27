<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\BaseControllerForClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends BaseControllerForClient
{
    public function index(){
        $announcements = $this->get('http://helpdesk.loc/api/admin/announcements');
        if (view()->exists('admin.announcement.index')){
        return view('admin.announcement.index',[
            'announcements' => $announcements->data
        ]);
        }
        else{
            abort(404);
        }
    }

    public function create()
    {
        $projects = $this->get('http://helpdesk.loc/api/admin/projects');
        return view('admin.announcement.create',[
            'projects' => $projects->data
        ]);
    }

    public function store(Request $request){
        $request = $request->except('_token');
        $announcement = $this->put('http://helpdesk.loc/api/admin/announcements',$request,true,'image');
        if($announcement == true)
        {
            return redirect()->route('announcement.index',app()->getLocale());
        }
    }

    public function show($id){
        $announcement = $this->get('http://helpdesk.loc/api/admin/announcements/'.$id);
        return view('admin.announcement.show',[
            'announcement' => $announcement->data
        ]);
    }

    public function edit($id){
        $announcement = $this->get('http://helpdesk.loc/api/admin/announcements/'.$id);
        $projects = $this->get('http://helpdesk.loc/api/admin/projects');
        return view('admin.announcement.edit',[
            'projects' => $projects->data,
            'announcement' => $announcement->data
        ]);
    }

    public function update(Request $request,$id){
        $request = $request->except('_token');
        $announcement = $this->put('http://helpdesk.loc/api/admin/announcements/'.$id,$request,true,'image');
        if ($announcement->success){
            return redirect()->route('announcement.index');
        }
    }

    public function destroy($id){
        $announcement = $this->delete('http://helpdesk.loc/api/admin/announcements/'.$id);
        if($announcement->success){
            return redirect()->route('announcement.index');
        }
    }
}
