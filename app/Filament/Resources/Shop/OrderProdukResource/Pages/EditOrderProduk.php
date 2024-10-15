<?php

namespace App\Filament\Resources\Shop\OrderProdukResource\Pages;

use App\Filament\Resources\Shop\OrderProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderProduk extends EditRecord
{
    protected static string $resource = OrderProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
