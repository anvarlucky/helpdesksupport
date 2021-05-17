<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;

class CategoryController extends BaseControllerForClient
{
    public function index()
    {
        $categories = $this->get('http://support.mc.uz/api/admin/categories');
        return view('admin.categories.index',[
            'categories' => $categories->data
        ]);
    }

    public function create()
    {
        $projects = $this->get('http://support.mc.uz/api/admin/projects');
        return view('admin.categories.create',
            [
                'projects' => $projects->data
            ]);
    }

    public function store(Request $request)
    {
        $request = $request->except('_token');
        $category = $this->post('http://support.mc.uz/api/admin/categories',$request);
        if($category->success)
        {
            return redirect()->route('categories.index');
        }

        return redirect()->back()->withErrors($category->errors);
    }

    public function show($id){
        $category = $this->get('http://support.mc.uz/api/admin/categories/'.$id);
        if($category->success){
            return view('admin.categories.show',[
                'category' => $category->data
            ]);
        }

    }

    public function edit($id){
        $projects = $this->get('http://support.mc.uz/api/admin/projects');
        $category = $this->get('http://support.mc.uz/api/admin/categories/'.$id);
        if($category->success) {
            return view('admin.categories.edit', [
                'category' => $category->data,
                'projects' => $projects->data
            ]);
        }
    }

    public function update(Request $request,$id){
        $request = $request->except('_token');
        $category = $this->put('http://support.mc.uz/api/admin/categories/'.$id,$request,false);
        if ($category->success){
            return redirect()->route('categories.index');
        }
    }

    public function destroy($id){
        $category = $this->delete('http://support.mc.uz/api/admin/categories/'.$id);
        if ($category->success){
            return redirect()->route('categories.index');
        }
    }
}
