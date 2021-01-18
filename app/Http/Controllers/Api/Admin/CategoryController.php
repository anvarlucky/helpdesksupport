<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseControllerForApi;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends BaseControllerForApi
{
    public function index()
    {
        $categories = Category::select('*','name->uz as name_uz')->get();
        return $this->responseSuccess($categories);
    }

    public function store(Request $request)
    {
        $request = [
            'name->uz' => $request->name['uz'],
            'name->ru' => $request->name['ru'],
            'name->en' => $request->name['en'],
        ];
        $category = Category::create($request);
        if($category)
        {
            return $this->responseSave($category);
        }
    }
}
