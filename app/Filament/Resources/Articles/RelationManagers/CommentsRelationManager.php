<?php

namespace App\Filament\Resources\Articles\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('author_name')
                    ->label('Author')
                    ->searchable(),

                TextColumn::make('body')
                    ->label('Comment')
                    ->limit(60),

                IconColumn::make('is_approved')
                    ->label('Approved')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->date('M j, Y')
                    ->sortable(),
            ])
            ->filters([])
            ->headerActions([
                CreateAction::make()
                    ->label('New Comment')
                    ->form([
                        TextInput::make('author_name')->required()->maxLength(255),
                        TextInput::make('author_email')->required()->email()->maxLength(255),
                        Textarea::make('body')->required()->rows(4),
                        Toggle::make('is_approved')->label('Approved')->default(true),
                    ]),
            ])
            ->recordActions([
                EditAction::make()
                    ->form([
                        TextInput::make('author_name')->required()->maxLength(255),
                        TextInput::make('author_email')->required()->email()->maxLength(255),
                        Textarea::make('body')->required()->rows(4),
                        Toggle::make('is_approved')->label('Approved'),
                    ]),
                DeleteAction::make(),
            ]);
    }
}
