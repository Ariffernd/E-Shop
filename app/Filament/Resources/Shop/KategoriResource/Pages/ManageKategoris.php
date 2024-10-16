<?php

namespace App\Filament\Resources\Shop\KategoriResource\Pages;

use App\Filament\Resources\Shop\KategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKategoris extends ManageRecords
{
    protected static string $resource = KategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
