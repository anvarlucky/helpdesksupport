<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
class AuthController extends Controller
{
/*    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!session()->has('authToken') && Route::current()->uri != 'login' && Route::current()->uri != '/'){
                return Redirect::to('/')->send();
            }
            $this->headers = [
                'Authorization' => 'Bearer '.session('access-token'),
                'Accept'        => 'application/json',
                'Language'      => app()->getLocale()
            ];
            return $next($request);
        });
        $this->client = new Client(['base_uri' => config('app.api_url')]);
 }*/

    public function login(Request $request)
    {

        if($request->isMethod('post')) {
            $client = new GuzzleHttp\Client(['base_uri' => 'http://helpdesk.loc']);
            //dd(session('_token'));
            //$response = $client->request('POST','api/login');
            $response = $client->request('POST', '/api/login', [
                'headers' => [
                    'Authorization' => 'Bearer '.session('access_token'),
                    'Accept' => 'application/json',
                ],
            ]);
            dd(json_decode($response->getBody()));
            if($response->getStatusCode()==200 && $response->data->token)
            {
                return "asdasd";
            }
            /*dd($this->post('/api/login', $request->except('_token')));
            $response = $this->post('api/login', $request->except('_token'));*/
        }
        return view('login');
    }

    public function logout()
    {

    }
}
