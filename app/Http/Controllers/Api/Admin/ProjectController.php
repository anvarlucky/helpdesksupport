<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $headers;
    public function __construct()
    {
        $this->headers = [
            'Accept' => 'application/json',
            'Language' => app()->getLocale(),
        ];
    }

    public function index()
    {
        $projects = Project::getAll();
        return response()->json([
           'success' => true,
           'lang' => app()->getLocale(),
            'data' => $projects,
            'status' => 200
        ]);
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
        $editProject = Project::getOne($id);
        $updateProject = Project::update([
                $editProject->name => $request->name,
                $editProject->url => $request->url
            ]);
        return response()->json([
            'success' => true,
            'lang' => app()->getLocale(),
            'data' => $updateProject,
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
        //
    }
}
