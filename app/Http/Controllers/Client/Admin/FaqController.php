<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\BaseControllerForClient;
use App\Models\v1\Faq;
use Illuminate\Http\Request;

class FaqController extends BaseControllerForClient
{
    public function index()
    {
        $faqs = $this->get('http://support.mc.uz/api/admin/faq');
        return view('admin.faq.index',[
            'faqs' => $faqs->data
        ]);
    }

    public function create()
    {
        $projects = $this->get('http://support.mc.uz/api/admin/projects');
        return view('admin.faq.create',[
            'projects' => $projects->data
        ]);
    }

    public function store(Request $request)
    {
        $request = $request->except('_token');
        $ticket = $this->put('http://support.mc.uz/api/admin/faq',$request,true,'file');
        if($ticket == true)
        {
            return redirect()->route('faq.index');
        }
    }

    public function show($id){
        $faq = $this->get('http://support.mc.uz/api/admin/faq/'.$id);
        if ($faq->success){
            return view('admin.faq.show',[
                'faq' => $faq->data
            ]);
        }
    }

    public function edit($id){
        $projects = $this->get('http://support.mc.uz/api/admin/projects');
        $faq = $this->get('http://support.mc.uz/api/admin/faq/'.$id);
        return view('admin.faq.edit',[
            'projects' => $projects->data,
            'faq' => $faq->data
        ]);
    }

    public function update(Request $request,$id){
        $request = $request->except('_token');
        $faq = $this->put('http://support.mc.uz/api/admin/faq/'.$id,$request,true,'file');
        if ($faq->success){
            return redirect()->route('faq.index');
        }
    }

    public function destroy($id){
        $faq = $this->delete('http://support.mc.uz/api/admin/faq/'.$id);
        if ($faq->success){
            return redirect()->route('faq.index');
        }
    }

}
