<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use App\Models\v1\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends BaseControllerForApi
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return $this->responseSuccess(Announcement::select('id','title')->get());
        return $this->responseSuccess(Announcement::announceProjects());
    }

    public function store(Request $request)
    {
        $requestAll = $request->except('_token');
        if($request->hasFile('image')) {
            $uploadFile = $request->file('image');
            $fileName = Announcement::uploadPhoto($uploadFile);
            $requestAll['image'] = $fileName;
        }
        else{
            $fileName = null;
        }
        $announcement = new Announcement;
        $announcement->title = $request->title;
        $announcement->text = $request->text;
        $announcement->image = $fileName;
        $announcement->date = $request->date;
        $announcement->save();
        $announcement->projects()->attach($request->projects);
        if($announcement){
            return $this->responseSave($announcement);
        }
    }

    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);
        return $this->responseSuccess($announcement);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $requestAll = $request->except('_token');
        if($request->hasFile('image')) {
            $uploadFile = $request->file('image');
            $fileName = Announcement::uploadPhoto($uploadFile);
            $requestAll['image'] = $fileName;
        }
        else{
            $fileName = null;
        }
        $announcement = Announcement::findOrFail($id);
        $announcement->title = $request->title;
        $announcement->text = $request->text;
        $announcement->image = $fileName;
        $announcement->date = $request->date;
        $announcement->save();
        if ($announcement==true && $request->projects !=null){
            foreach ($announcement->projects as $project) {
                $announcement->projects()->detach($project->id);
            }
            $announcement->projects()->attach($request->projects);
        }
        return $this->responseSuccess($announcement);
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $projects = $announcement->projects()->detach();
        if ($projects==true or $projects==null)
        return $this->responseDelete(Announcement::destroy($id));
    }
}

