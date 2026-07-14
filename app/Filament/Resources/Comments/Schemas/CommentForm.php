<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Comment Details')
                    ->columns(2)
                    ->schema([
                        Select::make('article_id')
                            ->label('Article')
                            ->relationship('article', 'title')
                            ->required()
                            ->searchable(),

                        TextInput::make('author_name')
                            ->label('Author')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('author_email')
                            ->label('Email')
                            ->required()
                            ->email()
                            ->maxLength(255),

                        Textarea::make('body')
                            ->label('Comment')
                            ->required()
                            ->columnSpanFull()
                            ->rows(4),

                        Toggle::make('is_approved')
                            ->label('Approved')
                            ->default(false),
                    ]),
            ]);
    }
}
