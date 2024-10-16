<?php

namespace App\Filament\Resources\Shop\ProdukResource\Pages;

use Filament\Actions;
use App\Http\Controllers\ProdukController;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Shop\ProdukResource;

class CreateProduk extends CreateRecord
{
    protected static string $resource = ProdukResource::class;

    protected function after(): void
    {
        app()->make(ProdukController::class)->NotifikasiProdukBaru($this->record);
    }   

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }


}
