<?php

namespace App\Filament\Resources\Shop\ProdukResource\Pages;

use Filament\Actions;
use App\Livewire\ProdukWidget;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Shop\ProdukResource;

class ListProduks extends ListRecords
{
    protected static string $resource = ProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Produk Baru'),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            ProdukWidget::class
        ];
    }
}
