<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\Category;
use App\Models\Author;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PostsCount extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Authors', Author::count())
                ->description('Total authors')
                ->descriptionIcon('heroicon-o-user', IconPosition::Before)
                ->descriptionColor("info"),
            Stat::make('Posts', Post::count())
                ->description('Total posts')
                ->descriptionIcon('heroicon-o-document-text', IconPosition::Before)
                ->descriptionColor("warning"),
            Stat::make('Categories', Category::count())
                ->description('Total categories')
                ->descriptionIcon('heroicon-o-folder', IconPosition::Before)
                ->descriptionColor("success"),
        ];
    }
}
