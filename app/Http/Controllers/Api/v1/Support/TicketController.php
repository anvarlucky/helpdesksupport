<?php

namespace App\Http\Controllers\Api\v1\Support;

use App\Http\Controllers\Api\v1\BaseControllerForApi;
use App\Models\v1\Category;
use App\Models\v1\Ticket;
use Illuminate\Http\Request;
use App\Models\v1\Project;
use App\Models\v1\Comment;
use Illuminate\Support\Facades\Auth;

class TicketController extends BaseControllerForApi
{
    public function index(){
        $projects = Project::all()->count();
        $project = Project::all();
        $tickets = Ticket::all();
        return $this->responseSuccess($projects);
    }

    public function projects(){
        $projects = Project::all();
        return $this->responseSuccess($projects);
    }


}
