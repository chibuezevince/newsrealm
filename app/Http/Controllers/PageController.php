<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function __invoke(string $slug)
    {
        $view = match ($slug) {
            'about' => 'pages.about',
            'terms' => 'pages.terms',
            'privacy' => 'pages.privacy',
            default => null,
        };

        if (! $view || ! view()->exists($view)) {
            abort(404);
        }

        return view($view);
    }
}
