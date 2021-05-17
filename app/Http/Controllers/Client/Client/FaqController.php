<?php

namespace App\Http\Controllers\Client\Client;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;

class FaqController extends BaseControllerForClient
{
    public function index(){
        $faqs = $this->get('http://support.mc.uz/api/client/faqclient');
        return view('client.faqs.index',[
            'faqs' => $faqs->data
        ]);
    }

    public function show($id)
    {
        $faq = $this->get('http://support.mc.uz/api/client/faqclient/'.$id);
        return view('client.faqs.show',[
            'faq' => $faq->data
        ]);

    }
}
