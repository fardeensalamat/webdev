<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
 
        
        if (! $request->user()->hasRole($role)) {
            return back();
        }

        


        if($role == 'company')
        {
 
            if (! $request->user()->hasCompanyOf($request->company)) 
            {
            abort(401);
            }
        }
        
        if($role == 'user')
        {
 
             if (! $request->user()->hasUserroleOf($request->user)) 
             {
                abort(401);
             }
        }  

        if($role == 'subrole')
        {
            if(! $request->user()->hasSubroleOf($request->subrole)) 
            {
                abort(401);
            }
        }   
        
        if($role == 'subscriber')
        {
       
            if(! $request->user()->subscriptions($request->subscription)->first()) 
            {
                abort(401);
            }
        } 

        return $next($request);
    }
}
