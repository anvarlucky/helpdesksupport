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
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!session()->has('authToken') && Route::current()->uri != 'login' && Route::current()->uri != '/'){
                return Redirect::to('/')->send();
            }
            $this->headers = [
                'Authorization' => 'Bearer '.session('access_token'),
                'Accept'        => 'application/json',
                'Language'      => app()->getLocale()
            ];
            return $next($request);
        });
        $this->client = new \GuzzleHttp\Client(['base_uri' => config('http://helpdesk.loc')]);
 }

    public function login(Request $request)
    {

        if($request->isMethod('post')) {
            $client = new GuzzleHttp\Client(['base_uri' => 'http://helpdesk.loc']);
            //dd(session('_token'));
            //$response = $client->request('POST','api/login');
            $request = $request->except('_token');
            $response = $client->request('POST', '/api/login', ['form_params' => $request, 'headers' => $this->headers]);
            dd(json_decode($response->getBody()));
            if($response ==true)
            {
                session(['access-token' => $response->data->token, 'user' => $response->data->user, 'role' => $response->data->role, 'scopes' => $response->data->scopes]);
                return redirect()->route('test');
            }
            /*dd($this->post('/api/login', $request->except('_token')));
            $response = $this->post('api/login', $request->except('_token'));*/
        }
        return view('login');
    }

    public function logout()
    {
        /*$client = new GuzzleHttp\Client(['base_uri' => 'http://helpdesk.loc']);
        $response = $client->request('GET', '/api/logout');*/
        Session::remove('access_token');
        return redirect('auth/login');

    }
}
