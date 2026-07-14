<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $articles = $category->articles()
            ->whereNotNull('published_at')
            ->with('category')
            ->latest('published_at')
            ->paginate(12);

        return view('categories.show', compact('category', 'articles'));
    }

    public function loadMore(Category $category, Request $request)
    {
        $page = $request->integer('page', 2);

        $articles = $category->articles()
            ->whereNotNull('published_at')
            ->with('category')
            ->latest('published_at')
            ->paginate(12, page: $page);

        $loadMoreUrl = route('categories.load-more', ['category' => $category->slug]).'?page='.($page + 1);

        return view('partials._article-grid-fragment', compact('articles', 'loadMoreUrl'));
    }
}
