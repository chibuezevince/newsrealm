<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function __invoke()
    {
        $trendingLeadArticle = Article::where('is_lead', true)
            ->whereNotNull('published_at')
            ->with('category')
            ->latest('updated_at')
            ->first();

        $trendingSidebarArticles = Article::where('is_trending', true)
            ->whereNotNull('published_at')
            ->with('category')
            ->latest('published_at')
            ->take(3)
            ->get();

        $latestNewsArticles = Article::whereNotNull('published_at')
            ->with('category')
            ->latest('published_at')
            ->take(6)
            ->get();

        $editorPickCategories = Category::whereIn('slug', [
            'business-finance',
            'cryptocurrency',
            'entertainment',
        ])->with([
            'articles' => function ($articleQuery) {
                $articleQuery->where('is_editor_pick', true)
                    ->whereNotNull('published_at')
                    ->with('category')
                    ->latest('published_at')
                    ->take(4);
            },
        ])->get();

        return view('home', compact(
            'trendingLeadArticle',
            'trendingSidebarArticles',
            'latestNewsArticles',
            'editorPickCategories',
        ));
    }
}
