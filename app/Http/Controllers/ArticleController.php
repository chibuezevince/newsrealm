<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->whereNotNull('published_at')
            ->with('category')
            ->latest('published_at')
            ->take(4)
            ->get();

        $comments = $article->comments()
            ->where('is_approved', true)
            ->latest()
            ->get();

        return view('articles.show', compact('article', 'relatedArticles', 'comments'));
    }

    public function storeComment(Request $request, Article $article)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'body' => ['required', 'string', 'max:5000'],
        ]);

        $comment = $article->comments()->create([
            'author_name' => $validated['name'],
            'author_email' => $validated['email'],
            'body' => $validated['body'],
            'is_approved' => false,
        ]);

        return back()->with('flash', 'Your comment has been submitted and will appear after review.');
    }
}
