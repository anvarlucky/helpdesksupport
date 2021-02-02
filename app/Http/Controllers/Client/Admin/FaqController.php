<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;

class FaqController extends BaseControllerForClient
{
    public function index()
    {
        $faqs = $this->get('http://helpdesk.loc/api/admin/faq');
        return view('admin.faq.index',[
            'faqs' => $faqs->data
        ]);
    }

    public function create()
    {
        $projects = $this->get('http://helpdesk.loc/api/admin/projects');
        return view('admin.faq.create',[
            'projects' => $projects->data
        ]);
    }

    public function store(Request $request)
    {
        $request = $request->except('_token');
        $ticket = $this->put('http://helpdesk.loc/api/admin/faq',$request,true,'file');
        if($ticket == true)
        {
            return redirect()->route('faq.index');
        }
    }
}
