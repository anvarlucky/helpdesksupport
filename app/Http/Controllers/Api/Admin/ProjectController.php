<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseControllerForApi;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends BaseControllerForApi
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $projects = Project::getAll();
        return response()->json([
           'success' => true,
           'lang' => app()->getLocale(),
            'data' => $projects,
            'status' => 200
        ])->withHeaders($this->headers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestAll = [
            'name' => $request->name,
            'url' => $request->url
        ];
        $project = Project::create($requestAll);
        return response()->json([
            'success' => true,
            'lang' => app()->getLocale(),
            'data' => $project,
            'status' => 201
        ])->withHeaders($this->headers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return $id;
        $editProject = Project::getOne($id);
        return response()->json([
            'success' => true,
            'lang' => app()->getLocale(),
            'data' => $editProject,
            'status' => 200
        ])->withHeaders($this->headers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteProject = Project::destroy($id);
        if($deleteProject== true)
        {
            return response()->json([
                'success' => true,
                'lang' => app()->getLocale(),
                'status' => 200
            ])->withHeaders($this->headers);
        }
    }
}
