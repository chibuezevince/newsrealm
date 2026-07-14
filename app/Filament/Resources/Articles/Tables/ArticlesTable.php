<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Image')
                    ->disk('public_assets')
                    ->width(60)
                    ->square(),

                TextColumn::make('title')
                    ->label('Title')
                    ->limit(40)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color(fn ($record) => $record->category?->color ?? 'gray'),

                TextColumn::make('author_name')
                    ->label('Author'),

                TextColumn::make('published_at')
                    ->label('Published')
                    ->date('M j, Y')
                    ->sortable(),

                IconColumn::make('is_trending')
                    ->label('Trending')
                    ->boolean(),

                IconColumn::make('is_editor_pick')
                    ->label('Editor Pick')
                    ->boolean(),

                IconColumn::make('is_lead')
                    ->label('Lead')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }
}
