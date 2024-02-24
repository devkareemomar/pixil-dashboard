<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

         App::setLocale(auth()->user()->language->short_name ?? 'ar');
//        $language=App::getLocale();
//        $language_id=Language::where('short_name',$language)->first()->id;
//        $request['language_id']=$language_id;
        return $next($request);
    }
}
