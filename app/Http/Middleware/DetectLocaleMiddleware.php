<?php namespace App\Http\Middleware;

use Closure;
use Symfony\Component\Translation\TranslatorInterface;

class DetectLocaleMiddleware
{
	/** @var TranslatorInterface  */
	protected $translator;

	/**
	 * @param TranslatorInterface $translator
	 */
	public function __construct(TranslatorInterface $translator){
		$this->translator = $translator;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
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
                    $this->translator->setLocale($lang);

                    return $next($request);
                }
            }
        }

        return $next($request);
    }
}
