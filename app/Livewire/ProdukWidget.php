<?php

namespace App\Livewire;

use App\Models\Shop\Produk;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ProdukWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Produk::count())
                ->icon('heroicon-o-shopping-bag'),
            Stat::make('Total Produk Aktif', function () {
                return Produk::where('status', true)->count();
            })
                ->icon('heroicon-o-clipboard-document-check'),

            Stat::make('Total Produk Non-Aktif', function () {
                return Produk::where('status', false)->count();
            })
                ->icon('heroicon-o-document-minus'),

            Stat::make('Total Stok Produk', function (): mixed {
                return Produk::sum('stok');
            })
                ->color('success')
                ->icon('heroicon-o-rectangle-stack'),
        ];
    }
}
