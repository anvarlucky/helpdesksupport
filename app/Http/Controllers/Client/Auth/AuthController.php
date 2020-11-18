<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $client;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!session()->has('access-token') && Route::current()->uri != 'login' && Route::current()->uri != '/'){
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
    }

    public function login(Request $request)
    {
        if($request->isMethod('post')) {
            //dd($request);
            $response = $this->post('api/login', $request->except('_token'));
            return redirect('login')->withErrors($response->errors);
            dd($response);

        }
        return view('login');
    }
}
