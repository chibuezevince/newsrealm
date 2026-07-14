<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Subscriber;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Articles', Article::count())
                ->description('Published content')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('info'),

            Stat::make('Categories', Category::count())
                ->description('Content categories')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('success'),

            Stat::make('Comments', Comment::count())
                ->description(Comment::where('is_approved', false)->count().' pending approval')
                ->descriptionIcon('heroicon-m-chat-bubble-left-ellipsis')
                ->color(Comment::where('is_approved', false)->count() > 0 ? 'warning' : 'success'),

            Stat::make('Subscribers', Subscriber::count())
                ->description('Newsletter subscribers')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('gray'),
        ];
    }
}
