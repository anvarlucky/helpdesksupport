<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;

class HomeController extends BaseControllerForClient
{
    public function index()
    {
        $statistics = $this->get('http://helpdesk.loc/api/admin/home');
        return view('admin.home',
            [
            'statistics' => $statistics
            ]
        );
    }
}
