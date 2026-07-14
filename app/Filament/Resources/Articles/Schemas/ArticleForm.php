<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ArticleForm {
    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                Section::make('Article Content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->required(),

                        TextInput::make('author_name')
                            ->label('Author')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('excerpt')
                            ->label('Excerpt')
                            ->columnSpanFull()
                            ->rows(3),
                    ])->columnSpanFull(),

                Section::make('Body')
                    ->schema([
                        RichEditor::make('body')
                            ->label('Body')
                            ->required()
                            ->fileAttachmentsDisk('public_assets')
                            ->fileAttachmentsDirectory('assets/uploads/images')
                            ->extraInputAttributes(['style' => 'min-height: 500px;']),
                    ])->columnSpanFull(),

                Section::make('Media')
                    ->columns(2)
                    ->schema([
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

                        FileUpload::make('featured_image')
                            ->label('Featured Image')
                            ->disk('public_assets')
                            ->directory('assets/uploads/images')
                            ->image()
                            ->maxSize(4096)
                            ->hidden(fn(Get $get): bool => $get('featured_image_source') !== 'upload'),

                        TextInput::make('featured_image')
                            ->label('Featured Image URL')
                            ->url()
                            ->placeholder('https://example.com/image.jpg')
                            ->hidden(fn(Get $get): bool => $get('featured_image_source') !== 'url'),

                        TextInput::make('video_url')
                            ->label('Video URL')
                            ->url()
                            ->placeholder('https://www.youtube.com/watch?v=...'),
                    ]),

                Section::make('Publishing')
                    ->columns(3)
                    ->schema([
                        DateTimePicker::make('published_at')
                            ->label('Published At'),

                        Toggle::make('is_trending')
                            ->label('Trending'),

                        Toggle::make('is_editor_pick')
                            ->label('Editor Pick'),

                        Toggle::make('is_lead')
                            ->label('Lead Article'),
                    ]),
            ]);
    }
}
