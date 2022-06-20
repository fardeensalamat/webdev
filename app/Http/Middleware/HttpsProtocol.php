<?php

namespace App\Http\Middleware;

use Closure;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
            if (!$request->secure() && env('APP_ENV') === 'production') {
                // return redirect()->secure($request->getRequestUri());

                //for force to www
	            if (substr($request->header('Host'), 0, 4)  !== 'www.') 
	            {
		               $request->headers->set('Host', 'www.softcodeint.com');

	               return redirect()->secure($request->path(), 301);
	            }
            }elseif($request->secure() && env('APP_ENV') === 'production')
            {
        		if (substr($request->header('Host'), 0, 4)  !== 'www.')
        		{
	               $request->headers->set('Host', 'www.softcodeint.com');

	               return redirect()->secure($request->path(), 301);
	            }
            }

            return $next($request); 
    }
}