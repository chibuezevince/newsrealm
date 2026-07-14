<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class CommentsChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected ?string $heading = 'Comments';

    protected ?string $description = 'Comments submitted per month';

    protected function getData(): array
    {
        $data = Trend::model(Comment::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Comments',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected ?string $maxHeight = '300px';

    protected ?string $pollingInterval = null;
}
