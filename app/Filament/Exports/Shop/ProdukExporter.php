<?php

namespace App\Filament\Exports\Shop;

use App\Models\Shop\Produk;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\Enums\ExportFormat;

class ProdukExporter extends Exporter
{
    protected static ?string $model = Produk::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('sku')
                ->label('SKU'),
            ExportColumn::make('nama_produk')
                ->label('Nama Produk'),
            ExportColumn::make('deskripsi')
                ->label('Deskripsi Produk'),
            ExportColumn::make('berat_barang')
                ->label('Berat Barang'),
            ExportColumn::make('satuan')
                ->label('Berat'),
            ExportColumn::make('stok')
                ->label('Stok'),
            ExportColumn::make('harga')
                ->label('Harga'),
        ];
    }


    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Data Produk Berhasil di Export ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
