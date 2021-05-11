<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use App\Http\Requests\Admin\Faq\FaqCreateRequest;
use App\Models\v1\Faq;
use Illuminate\Http\Request;

class FaqController extends BaseControllerForApi
{
    public function index()
    {
        $faqs = Faq::projectsFaq();
        return $this->responseSuccess($faqs);
    }

    public function store(FaqCreateRequest $request)
    {
        $requestAll = $request->except('_token');
        if($request->hasFile('file')){
            $uploadFile = $request->file('file');
            $fileName = Faq::uploadFile($uploadFile);
            $requestAll['file'] = $fileName;
        }
        else{
            $fileName = null;
            $faq = Faq::create($request->all());
            return $this->responseSave($faq);
        }
        $request = [
          'project_id' => $request->project_id,
          'title->uz' => $request->title['uz'],
          'title->ru' => $request->title['ru'],
          'title->en' => $request->title['en'],
          'text->uz' => $request->text['uz'],
          'text->ru' => $request->text['ru'],
          'text->en' => $request->text['en'],
          'file' => $fileName
        ];
        $faq = Faq::create($request);
        return $this->responseSave($faq);

    }

    public function show($id){
        //$faq = Faq::select('*','title->uz as title_uz','title->ru as title_ru','title->en as title_en','text->uz as text_uz','text->ru as text_ru','text->en as text_en')->findOrFail($id);
        $faq = Faq::projectFaq($id);
        return $this->responseSuccess($faq);
    }

    public function update(Request $request,$id){
        $faq = Faq::findOrFail($id);
        $faq->update($request->all());
        return $this->responseUpdate($faq);
    }

    public function destroy($id){
        return $this->responseDelete(Faq::destroy($id));
    }
}
