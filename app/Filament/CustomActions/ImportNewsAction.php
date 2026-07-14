<?php

namespace App\Filament\CustomActions;

use App\Models\Article;
use App\Models\Category;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ImportNewsAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Import News')
            ->icon('heroicon-m-arrow-down-tray')
            ->color('success')
            ->modalHeading('Import News Articles')
            ->modalDescription('Fetch articles from the Currents API and import them into the site.')
            ->modalSubmitActionLabel('Import')
            ->form([
                Select::make('language')
                    ->label('Language')
                    ->options([
                        'en' => 'English',
                        'es' => 'Spanish',
                        'de' => 'German',
                        'fr' => 'French',
                        'pt' => 'Portuguese',
                        'ru' => 'Russian',
                    ])
                    ->default('en')
                    ->required(),

                Select::make('category')
                    ->label('News category')
                    ->helperText('Filter news from the API by topic.')
                    ->options([
                        'all' => 'All',
                        'regional' => 'Regional',
                        'technology' => 'Technology',
                        'lifestyle' => 'Lifestyle',
                        'business' => 'Business',
                        'general' => 'General',
                        'programming' => 'Programming',
                        'science' => 'Science',
                        'entertainment' => 'Entertainment',
                        'world' => 'World',
                        'sports' => 'Sports',
                        'finance' => 'Finance',
                        'academia' => 'Academia',
                        'politics' => 'Politics',
                        'health' => 'Health',
                        'opinion' => 'Opinion',
                        'food' => 'Food',
                        'game' => 'Game',
                    ])
                    ->default('all'),

                TextInput::make('count')
                    ->label('Number of articles')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(15)
                    ->default(15)
                    ->required(),
            ])
            ->action(function (array $data) {
                $apiKey = config('services.currentapi.API_KEY');

                if (! $apiKey) {
                    Notification::make()
                        ->title('API key not configured.')
                        ->body('Set CURRENT_API_NEWS_API_KEY in your .env file.')
                        ->danger()
                        ->send();

                    return;
                }

                $limit = (int) $data['count'];
                $apiCategory = $data['category'];

                $params = [
                    'apiKey' => $apiKey,
                    'language' => $data['language'],
                    'page_size' => min($limit, 50),
                ];

                if ($apiCategory !== 'all') {
                    $params['category'] = $apiCategory;
                }

                $response = Http::timeout(30)
                    ->get('https://api.currentsapi.services/v1/latest-news', $params);

                if (! $response->successful()) {
                    Notification::make()
                        ->title('API request failed.')
                        ->body("Status: {$response->status()} - ".$response->body())
                        ->danger()
                        ->send();

                    return;
                }

                $body = $response->json();

                if (empty($body['news'])) {
                    Notification::make()
                        ->title('No articles found.')
                        ->warning()
                        ->send();

                    return;
                }

                info('Currents API full response', $body);

                $imported = 0;

                foreach ($body['news'] as $news) {
                    if ($imported >= $limit) {
                        break;
                    }

                    $title = trim($news['title'] ?? '');
                    $imageUrl = $news['image'] ?? null;

                    if (! $title || ! $imageUrl || Article::where('title', $title)->exists()) {
                        continue;
                    }

                    if (strlen($title) < 15) {
                        continue;
                    }

                    if (! preg_match('/\.(jpe?g|png|webp|gif|bmp)(\?.*)?$/i', $imageUrl)) {
                        continue;
                    }

                    $slug = Str::slug($title);
                    if (Article::where('slug', $slug)->exists()) {
                        $slug .= '-'.Str::random(5);
                    }

                    $description = trim($news['description'] ?? '');

                    if (strlen($description) < 20) {
                        continue;
                    }

                    $bodyContent = '<p>'.nl2br(e($description)).'</p>';

                    $publishedAt = $news['published'] ?? now()->toDateTimeString();
                    $newsCategories = $news['category'] ?? ['general'];
                    $matchedSlug = is_array($newsCategories) ? $newsCategories[0] : $newsCategories;
                    $matchedCategory = Category::where('slug', $matchedSlug)->first();
                    $categoryId = $matchedCategory?->id ?? Category::where('slug', 'general')->value('id');

                    Article::create([
                        'title' => $title,
                        'slug' => $slug,
                        'excerpt' => Str::limit(strip_tags($description ?: $bodyContent), 200),
                        'body' => $bodyContent,
                        'featured_image' => $imageUrl,
                        'category_id' => (int) $categoryId,
                        'author_name' => $news['author'] ?? 'NewsRealm',
                        'published_at' => $publishedAt ? date('Y-m-d H:i:s', strtotime($publishedAt)) : now(),
                        'is_trending' => false,
                        'is_editor_pick' => false,
                        'is_lead' => false,
                    ]);

                    $imported++;
                }

                Notification::make()
                    ->title("Imported {$imported} articles.")
                    ->success()
                    ->send();
            });
    }
}
