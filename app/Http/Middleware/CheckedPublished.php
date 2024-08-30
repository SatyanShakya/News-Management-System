<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CheckedPublished
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
        if(Auth::check()&& Auth::user()->published !=1){
            Auth::logout();
            return redirect()->route("login")->with("error","The User is Inactive");
        }

        return $next($request);

        // for changing password
        if (Auth::check()) {
            $currentPasswordHash = Auth::user()->password;

            // Check if the current password hash is different from the one in the session
            if (Hash::check($currentPasswordHash, Auth::user()->getAuthPassword())) {
                return $next($request);
            }

            Auth::logout();
            return redirect()->route("login");
        }

        return $next($request);

    }
}
