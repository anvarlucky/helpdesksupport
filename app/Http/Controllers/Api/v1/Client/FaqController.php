<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use Illuminate\Http\Request;
use App\Models\v1\Faq;

class FaqController extends BaseControllerForApi
{
    public function index(){
        $faqs = Faq::select('*','title->uz as title_uz')->get();
        return $this->responseSuccess($faqs);
    }

    public function show($id)
    {
        $ticket = Faq::findOrFail($id);
        return $this->responseSuccess($ticket);
    }
}
