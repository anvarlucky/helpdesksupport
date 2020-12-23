<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Client\BaseControllerForClient;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class TestController extends BaseControllerForClient
{
    public function test()
    {
        $client = new Client(['base_uri' => 'http://helpdesk.loc']);
        $response = $client->request('GET', '/api/admin/projects');
        dd(json_decode($response->getBody()));
    }
}
