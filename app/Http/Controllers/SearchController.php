<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('q');

        $searchResults = Article::whereNotNull('published_at')
            ->when($query, function ($queryBuilder, $query) {
                $queryBuilder->where('title', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%")
                    ->orWhere('body', 'like', "%{$query}%");
            })
            ->with('category')
            ->latest('published_at')
            ->paginate(12)
            ->appends(['q' => $query]);

        return view('search', compact('searchResults', 'query'));
    }

    public function loadMore(Request $request)
    {
        $query = $request->input('q');
        $page = $request->integer('page', 2);

        $articles = Article::whereNotNull('published_at')
            ->when($query, function ($queryBuilder, $query) {
                $queryBuilder->where('title', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%")
                    ->orWhere('body', 'like', "%{$query}%");
            })
            ->with('category')
            ->latest('published_at')
            ->paginate(12, page: $page)
            ->appends(['q' => $query]);

        $loadMoreUrl = route('search.load-more').'?page='.($page + 1).'&q='.urlencode($query ?? '');

        return view('partials._article-grid-fragment', compact('articles', 'loadMoreUrl'));
    }
}
