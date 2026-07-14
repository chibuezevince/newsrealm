<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestArticlesTable extends TableWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = 'Latest Articles';

    protected ?string $description = 'Most recently published articles';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Article::query()->latest('published_at')
            )
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->limit(40)
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color(fn ($record) => $record->category?->color ?? 'gray'),

                TextColumn::make('author_name')
                    ->label('Author'),

                IconColumn::make('is_trending')
                    ->label('Trending')
                    ->boolean(),

                IconColumn::make('is_editor_pick')
                    ->label('Editor Pick')
                    ->boolean(),

                TextColumn::make('published_at')
                    ->label('Published')
                    ->date('M j, Y')
                    ->sortable(),
            ])
            ->paginated(false)
            ->defaultSort('published_at', 'desc');
    }
}
