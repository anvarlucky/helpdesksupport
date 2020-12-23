<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BaseControllerForClient extends Controller
{
    protected const CODE_VALIDATION_SUCCESS = 200;
    protected const CODE_VALIDATION_ERROR = 422;
    protected const CODE_MANY_REQUESTS = 429;
    protected const CODE_SUCCESS_UPDATED = 202;
    protected const CODE_SUCCESS_CREATED = 201;
    protected const CODE_SUCCESS_DELETED = 202;
    protected const CODE_UNAUTHORIZED = 401;
    protected const CODE_NOTFOUND = 404;
    protected const CODE_ACCESS_DENIED = 403;
    protected $client;

    public function __construct()
    {
        $this->headers = [
            'Accept'        => 'application/json',
            'Language'      => app()->getLocale()
        ];
        $this->client = new Client(['base_uri' => config('app.api_url')]);
    }
}
