<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;

class CategoryController extends BaseControllerForClient
{
    public function index()
    {
        $categories = $this->get('http://helpdesk.loc/api/admin/categories');
        return view('admin.categories.index',[
            'categories' => $categories->data
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request = $request->except('_token');
        $category = $this->post('http://helpdesk.loc/api/admin/categories',$request);
        if($category->success)
        {
            return redirect()->route('categories.index');
        }

        return redirect()->back()->withErrors($category->errors);
    }
}
