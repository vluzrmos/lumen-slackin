<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Lang;

class DetectLocaleMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $langs = preg_split('/,/',$request->header('Accept-Language'));

        foreach($langs as $lang){
            $lang = trim($lang);

            if(is_dir(base_path('resources/lang/'.$lang))){
                Lang::setLocale($lang);

                break;
            }
        }

        return $next($request);
    }

}
