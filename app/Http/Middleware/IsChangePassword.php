<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsChangePassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ((auth()->user()->is_admin == 0 && auth()->user()->is_change_password == 1) || auth()->user()->is_admin == 1) {
            return $next($request);
        }

        return redirect('/user/' . auth()->user()->id . '/edit-password')->with('error', 'You have to change the password first!');
    }
}
