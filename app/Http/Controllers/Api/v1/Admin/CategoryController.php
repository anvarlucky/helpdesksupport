<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use App\Http\Requests\Admin\Categories\CategoryCreateRequest;
use App\Models\v1\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseControllerForApi
{
    public function index()
    {
        $categories = Category::select('*','name->uz as name_uz')->get();
        return $this->responseSuccess($categories);
    }

    public function store(CategoryCreateRequest $request)
    {
        $category = Category::create($request->all());
        return $this->responseSave($category);
    }

    public function show($id){
        $category = Category::select('*','name->uz as name_uz','name->ru as name_ru', 'name->en as name_en')->findOrFail($id);
        return $this->responseSuccess($category);
    }

    public function update(Request $request, $id){
        $category = Category::select('*','name->uz as name_uz','name->ru as name_ru', 'name->en as name_en')->findOrFail($id);
        $category->update($request->all());
        return $this->responseUpdate($category);
    }

    public function destroy($id){
        $category = Category::destroy($id);
        return $this->responseSuccess($category);
    }
}
