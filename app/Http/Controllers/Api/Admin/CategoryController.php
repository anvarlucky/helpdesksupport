<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseControllerForApi;
use App\Http\Requests\Admin\Categories\CategoryCreateRequest;
use App\Models\Category;

class CategoryController extends BaseControllerForApi
{
    public function index()
    {
        $categories = Category::select('*','name->uz as name_uz')->get();
        return $this->responseSuccess($categories);
    }

    public function store(CategoryCreateRequest $request)
    {
        $request = [
            'name->uz' => $request->name['uz'],
            'name->ru' => $request->name['ru'],
            'name->en' => $request->name['en'],
        ];
        $category = Category::create($request);
        return $this->responseSave($category);
    }
}
