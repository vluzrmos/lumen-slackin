<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Lang;

class DetectLocaleMiddleware
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
        $pairs = preg_split('/; ?/', $request->header('Accept-Language'));

        foreach ($pairs as $pair) {
            $langs = preg_split('/, ?/', $pair);

            foreach ($langs as $lang) {
                $lang = strtolower(trim($lang));

                if (is_dir(base_path('resources/lang/'.$lang))) {
                    Lang::setLocale($lang);

                    return $next($request);
                }
            }
        }

        return $next($request);
    }
}
