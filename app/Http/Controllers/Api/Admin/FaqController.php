<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseControllerForApi;
use App\Http\Requests\Admin\Faq\FaqCreateRequest;
use App\Models\Faq;

class FaqController extends BaseControllerForApi
{
    public function index()
    {
        $faqs = Faq::select('*','title->uz as title_uz')->get();
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
}
