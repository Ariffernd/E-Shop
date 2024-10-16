<?php

namespace App\Filament\Resources\Shop\SubKategoriResource\Pages;

use App\Filament\Resources\Shop\SubKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSubKategoris extends ManageRecords
{
    protected static string $resource = SubKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
