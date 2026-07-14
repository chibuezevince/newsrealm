<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:subscribers,email'],
        ]);

        Subscriber::create($validated);

        return back()->with('flash', 'You have been subscribed successfully!');
    }
}
