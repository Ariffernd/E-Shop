<?php

namespace App\Filament\Resources\Shop\OrderProdukResource\Pages;

use App\Filament\Resources\Shop\OrderProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrderProduks extends ListRecords
{
    protected static string $resource = OrderProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
