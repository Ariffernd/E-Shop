<?php

namespace App\Livewire;

use App\Models\Shop\Produk;
use Filament\Actions\Action;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class DashboardWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Produk::count())
                ->icon('heroicon-o-shopping-bag'),
            Stat::make('Total Stok Produk Habis', Produk::where('stok', 0)->count())
                ->icon('heroicon-o-minus-circle'),

        ];
    }
}
