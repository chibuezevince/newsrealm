<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticlesRelationManager extends RelationManager {
    protected static string $relationship = 'articles';

    public function table(Table $table): Table {
        return $table
            ->columns([
                ImageColumn::make('featured_image')->label('Image')->disk('public_assets')->width(60)->circular(),
                TextColumn::make('title')->label('Title')->limit(40)->searchable(),
                TextColumn::make('author_name')->label('Author'),
                TextColumn::make('published_at')->label('Published')->date('M j, Y')->sortable(),
                IconColumn::make('is_trending')->label('Trending')->boolean(),
                IconColumn::make('is_editor_pick')->label('Editor Pick')->boolean(),
                IconColumn::make('is_lead')->label('Lead')->boolean(),
            ])
            ->filters([])
            ->headerActions([
                CreateAction::make()
                    ->label('New Article')
                    ->form([
                        TextInput::make('title')->required()->maxLength(255),
                        TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
                        Select::make('category_id')->relationship('category', 'name')->required(),
                        TextInput::make('author_name')->required()->maxLength(255),
                        RichEditor::make('body')->required()->fileAttachmentsDisk('public_assets')->fileAttachmentsDirectory('assets/uploads/images'),
                        Select::make('featured_image_source')
                            ->label('Image Source')
                            ->options([
                                'upload' => 'Upload Image',
                                'url' => 'External URL',
                            ])
                            ->live()
                            ->dehydrated(false)
                            ->default('upload'),
                        FileUpload::make('featured_image')->disk('public_assets')->directory('assets/uploads/images')->image()->maxSize(4096)
                            ->hidden(fn(Get $get): bool => $get('featured_image_source') !== 'upload'),
                        TextInput::make('featured_image')
                            ->label('Featured Image URL')
                            ->url()
                            ->placeholder('https://example.com/image.jpg')
                            ->hidden(fn(Get $get): bool => $get('featured_image_source') !== 'url'),
                        TextInput::make('video_url')->url(),
                        Textarea::make('excerpt')->rows(3),
                        DateTimePicker::make('published_at'),
                        Toggle::make('is_trending'),
                        Toggle::make('is_editor_pick'),
                        Toggle::make('is_lead'),
                    ]),
            ])
            ->recordActions([
                EditAction::make()
                    ->form([
                        TextInput::make('title')->required()->maxLength(255),
                        TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
                        Select::make('category_id')->relationship('category', 'name')->required(),
                        TextInput::make('author_name')->required()->maxLength(255),
                        RichEditor::make('body')->required()->fileAttachmentsDisk('public_assets')->fileAttachmentsDirectory('assets/uploads/images'),
                        Select::make('featured_image_source')
                            ->label('Image Source')
                            ->options([
                                'upload' => 'Upload Image',
                                'url' => 'External URL',
                            ])
                            ->live()
                            ->dehydrated(false)
                            ->default(function ($record) {
                                if (
                                    $record?->featured_image
                                    && (str_starts_with($record->featured_image, 'http://')
                                        || str_starts_with($record->featured_image, 'https://'))
                                ) {
                                    return 'url';
                                }

                                return 'upload';
                            }),
                        FileUpload::make('featured_image')->disk('public_assets')->directory('assets/uploads/images')->image()->maxSize(2048)
                            ->hidden(fn(Get $get): bool => $get('featured_image_source') !== 'upload'),
                        TextInput::make('featured_image')
                            ->label('Featured Image URL')
                            ->url()
                            ->placeholder('https://example.com/image.jpg')
                            ->hidden(fn(Get $get): bool => $get('featured_image_source') !== 'url'),
                        TextInput::make('video_url')->url(),
                        Textarea::make('excerpt')->rows(3),
                        DateTimePicker::make('published_at'),
                        Toggle::make('is_trending'),
                        Toggle::make('is_editor_pick'),
                        Toggle::make('is_lead'),
                    ]),
                DeleteAction::make(),
            ]);
    }
}
