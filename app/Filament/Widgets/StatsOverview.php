<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use App\Models\Equipment;
use App\Models\Goods;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Funcionarios', Employee::count())
                ->icon('heroicon-s-user-group'),
            Stat::make('Equipos', Equipment::count())
                ->icon('heroicon-s-computer-desktop'),
            Stat::make('Bienes', Goods::count())
                ->icon('heroicon-s-archive-box')
        ];
    }
}
