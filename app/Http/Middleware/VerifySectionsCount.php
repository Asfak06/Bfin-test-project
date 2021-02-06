<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Section;
use Illuminate\Http\Request;

class VerifySectionsCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Section::all()->count() === 0) {
          session()->flash('error', 'You need to add sections to be able to create a story.');

          return redirect(route('sections.create'));
        }
        return $next($request);
    }
}
