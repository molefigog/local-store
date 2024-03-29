<?php

namespace App\Filament\Widgets;

use App\Models\Music;
use App\Models\User;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            stat::make('Total Songs', Music::count())->description('increase in music')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success')->chart([2,3,8,1,3,9]),
            stat::make('Total Users', User::count())->descriptionIcon('heroicon-m-arrow-trending-up'),
            stat::make('Total Posts', Product::count())->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
