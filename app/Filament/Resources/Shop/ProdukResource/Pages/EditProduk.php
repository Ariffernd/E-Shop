<?php

namespace App\Filament\Resources\Shop\ProdukResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Http\Controllers\ProdukController;
use App\Filament\Resources\Shop\ProdukResource;

class EditProduk extends EditRecord
{
    protected static string $resource = ProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function afterSave(): void
    {
        app()->make(ProdukController::class)->NotifikasiProdukEdit($this->record);
    }


}
