<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseControllerForApi extends Controller
{
    protected $headers;
    protected const CODE_VALIDATION_ERROR = 422;
    protected const CODE_SUCCESS_UPDATED = 202;
    protected const CODE_SUCCESS_CREATED = 201;
    protected const CODE_SUCCESS_DELETED = 202;
    protected const CODE_SUCCESS_FALSE = 555;
    protected const CODE_ACCESS_DENIED = 403;

    public function __construct(){
        $this->headers = [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json',
            'Language' => app()->getLocale()
        ];
    }
}
