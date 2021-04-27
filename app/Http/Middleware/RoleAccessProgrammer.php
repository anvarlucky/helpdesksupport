<?php

namespace App\Http\Middleware;

use Closure;

class RoleAccessProgrammer
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
        elseif ($user==4)
        {
            return redirect()->route('logout',app()->getLocale());
        }
        elseif ($user==3)
        {
            return redirect()->route('logout',app()->getLocale());
        }
        return $next($request);
    }
}
