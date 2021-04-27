<?php

namespace App\Http\Middleware;

use Closure;

class roleSupport
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = session('role');
        if ($user==1)
        {
            return redirect()->route('logout',app()->getLocale());
        }
        elseif ($user==2)
        {
            return redirect()->route('logout',app()->getLocale());
        }
        elseif($user == 4){
            return redirect()->route('logout',app()->getLocale());
        }
        else{
        return $next($request);
        }
    }
}
