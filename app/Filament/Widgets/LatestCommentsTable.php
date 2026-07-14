<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestCommentsTable extends TableWidget
{
    protected static ?int $sort = 5;

    protected static ?string $heading = 'Recent Comments';

    protected ?string $description = 'Most recent comments submitted';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Comment::query()->latest()
            )
            ->columns([
                TextColumn::make('article.title')
                    ->label('Article')
                    ->limit(30)
                    ->searchable(),

                TextColumn::make('author_name')
                    ->label('Author')
                    ->searchable(),

                TextColumn::make('body')
                    ->label('Comment')
                    ->limit(50),

                IconColumn::make('is_approved')
                    ->label('Approved')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->date('M j, Y'),
            ])
            ->paginated(false)
            ->defaultSort('created_at', 'desc');
    }
}
